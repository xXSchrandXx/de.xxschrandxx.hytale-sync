<?php

namespace wcf\data\user\group\hytale;

use wcf\data\AbstractDatabaseObjectAction;

/**
 * HytaleGroup Action class
 *
 * @author   xXSchrandXx
 * @package  WoltLabSuite\Core\Data\User\Group\Hytale
 */
class HytaleGroupAction extends AbstractDatabaseObjectAction
{
    /**
     * @inheritDoc
     */
    protected $className = HytaleGroupEditor::class;

    /**
     * @inheritDoc
     */
    protected $permissionsCreate = ['admin.hytaleSync.canManage'];

    /**
     * @inheritDoc
     */
    protected $permissionsDelete = ['admin.hytaleSync.canManage'];
}
