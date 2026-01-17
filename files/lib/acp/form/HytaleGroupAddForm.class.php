<?php

namespace wcf\acp\form;

use wcf\data\hytale\Hytale;
use wcf\data\hytale\HytaleList;
use wcf\data\user\group\hytale\HytaleGroup;
use wcf\data\user\group\hytale\HytaleGroupAction;
use wcf\data\user\group\hytale\HytaleGroupList;
use wcf\data\user\group\UserGroup;
use wcf\form\AbstractFormBuilderForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\form\builder\container\FormContainer;
use wcf\system\form\builder\field\BooleanFormField;
use wcf\system\form\builder\field\TextFormField;
use wcf\system\form\builder\field\TitleFormField;
use wcf\system\form\builder\field\validation\FormFieldValidationError;
use wcf\system\form\builder\field\validation\FormFieldValidator;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * HytaleGroup add acp form class
 *
 * @author   xXSchrandXx
 * @license  Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @package  WoltLabSuite\Core\Acp\Form
 */
class HytaleGroupAddForm extends AbstractFormBuilderForm
{
    /**
     * @var \wcf\data\user\hytale\HytaleGroup
     */
    public $formObject;

    /**
     * @inheritDoc
     */
    public $neededModules = ['HYTALE_SYNC_ENABLED','HYTALE_SYNC_IDENTITY'];

    /**
     * @inheritDoc
     */
    public $neededPermissions = ['admin.hytaleSync.canManage'];

    /**
     * @inheritDoc
     */
    public $activeMenuItem = 'wcf.acp.menu.link.group.list';

    /**
     * @inheritDoc
     */
    public $objectActionClass = HytaleGroupAction::class;

    /**
     * @var Hytale
     */
    protected $hytale;

    /**
     * @var UserGroup
     */
    protected $group;

    /**
     * @inheritDoc
     */
    public function readParameters()
    {
        parent::readParameters();

        if ($this->formAction == 'create') {
            $groupID = 0;
            if (isset($_REQUEST['id'])) {
                $groupID = (int)$_REQUEST['id'];
            }
            $this->group = new UserGroup($groupID);
            if (!$this->group->getObjectID()) {
                throw new IllegalLinkException();
            }
            $hytaleID = 0;
            if (isset($_REQUEST['hytaleID'])) {
                $hytaleID = (int)$_REQUEST['hytaleID'];
            }
            $this->hytale = new Hytale($hytaleID);
            if (!$this->hytale->getObjectID()) {
                throw new IllegalLinkException();
            }
        } else {
            $hytaleGroupID = 0;
            if (isset($_REQUEST['id'])) {
                $hytaleGroupID = (int)$_REQUEST['id'];
            }
            $this->formObject = new HytaleGroup($hytaleGroupID);
            if (!$this->formObject->getObjectID()) {
                throw new IllegalLinkException();
            }
            if (!$this->formObject->getObjectID()) {
                throw new IllegalLinkException();
            }
            $this->group = new UserGroup($this->formObject->getGroupID());
            $this->hytale = new Hytale($this->formObject->getHytaleID());
        }
    }

    /**
     * @inheritDoc
     */
    public function createForm()
    {
        parent::createForm();

        $this->form->appendChild(
            FormContainer::create('data')
                ->appendChildren([
                    TextFormField::create('hytaleName')
                        ->required()
                        ->label('wcf.acp.form.hytaleGroupAdd.hytaleName')
                        ->description('wcf.acp.form.hytaleGroupAdd.hytaleName.description')
                        ->maximumLength(30)
                        ->addValidator(new FormFieldValidator('duplicate', function (TextFormField $field) {
                            if ($this->formAction == 'edit' && $field->getValue() == $this->formObject->getGroupName()) {
                                return;
                            }
                            $hytaleGroupList = new HytaleGroupList();
                            $hytaleGroupList->getConditionBuilder()->add('hytaleName = ? AND hytaleID = ? AND groupID = ?', [$field->getValue(), $this->hytale->getObjectID(), $this->group->getObjectID()]);
                            if ($hytaleGroupList->countObjects() > 0) {
                                $field->addValidationError(
                                    new FormFieldValidationError(
                                        'duplicate',
                                        'wcf.acp.form.hytaleGroupAdd.hytaleName.error.duplicate'
                                    )
                                );
                            }
                        })),
                    BooleanFormField::create('shouldHave')
                        ->label('wcf.acp.form.hytaleGroupAdd.shouldHave')
                        ->description('wcf.acp.form.hytaleGroupAdd.shouldHave.description')
                ])
        );
    }

    /**
     * @inheritDoc
     */
    public function save()
    {
        if ($this->formAction == 'edit') {
            parent::save();
            return;
        }
        $this->additionalFields['hytaleID'] = $this->hytale->getObjectID();
        $this->additionalFields['groupID'] = $this->group->getObjectID();

        parent::save();
    }

    /**
     * @inheritDoc
     */
    public function assignVariables()
    {
        parent::assignVariables();

        WCF::getTPL()->assign([
            'hytaleID' => $this->hytale->getObjectID(),
            'groupID' => $this->group->getObjectID()
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function setFormAction()
    {
        if ($this->formAction == 'create') {
            $this->form->action(LinkHandler::getInstance()->getControllerLink(static::class, ['id' => $this->group->getObjectID(), 'hytaleID' => $this->hytale->getObjectID()]));
        } else {
            parent::setFormAction();
        }
    }
}
