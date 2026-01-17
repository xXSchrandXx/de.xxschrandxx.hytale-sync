<?php

namespace wcf\action;

use Laminas\Diactoros\Response\JsonResponse;
use wcf\data\user\group\hytale\HytaleGroupList;
use wcf\data\user\group\UserGroupList;
use wcf\util\HytaleLinkerUtil;

/**
 * HytaleSyncGetGroup action class
 *
 * @author   xXSchrandXx
 * @license  Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @package  WoltLabSuite\Core\Action
 */
#[\wcf\http\attribute\DisableXsrfCheck]
class HytaleSyncGetGroupsAction extends AbstractHytaleLinkerAction
{
    /**
     * @inheritDoc
     */
    public $neededModules = ['HYTALE_SYNC_ENABLED'];

    /**
     * @inheritDoc
     */
    public $availableHytaleIDs = HYTALE_SYNC_IDENTITY;

    /**
     * @inheritdoc
     */
    public function execute($parameters): JsonResponse
    {
        $user = HytaleLinkerUtil::getUser($parameters['uuid']);
        if (!isset($user)) {
            if (ENABLE_DEBUG_MODE) {
                return $this->send('Bad Request. \'uuid\' is not linked.', 400);
            } else {
                return $this->send('Bad request.', 400);
            }
        }

        $groupIDs = $user->getGroupIDs(true);

        $hytaleGroupList = new HytaleGroupList();
        $hytaleGroupList->getConditionBuilder()->add('hytaleID = ? AND groupID IN (?)', [$parameters['hytaleID'], $groupIDs]);
        $hytaleGroupList->readObjects();
        /** @var \wcf\data\user\group\hytale\HytaleGroup[] */
        $hytaleGroups = $hytaleGroupList->getObjects();

        $hytaleGroupsGroupIDs = [];
        foreach ($hytaleGroups as $hytaleGroup) {
            array_push($hytaleGroupsGroupIDs, $hytaleGroup->getGroupID());
        }

        $userGroupList = new UserGroupList();
        $userGroupList->setObjectIDs($hytaleGroupsGroupIDs);
        $userGroupList->readObjects();
        /** @var \wcf\data\user\group\UserGroup[] */
        $userGroups = $userGroupList->getObjects();

        $shouldHave = [];
        $shouldNotHave = [];
        foreach ($hytaleGroups as $hytaleGroup) {
            if ($hytaleGroup->getShouldHave()) {
                if (array_key_exists($hytaleGroup->getGroupName(), $shouldNotHave)) {
                    if ($userGroups[$hytaleGroup->getGroupID()]->priority > $shouldNotHave[$hytaleGroup->getGroupName()]) {
                        unset($shouldNotHave[$hytaleGroup->getGroupName()]);
                    } else {
                        continue;
                    }
                }
                $shouldHave[$hytaleGroup->getGroupName()] = $userGroups[$hytaleGroup->getGroupID()]->priority;
            } else {
                if (array_key_exists($hytaleGroup->getGroupName(), $shouldHave)) {
                    if ($userGroups[$hytaleGroup->getGroupID()]->priority > $shouldHave[$hytaleGroup->getGroupName()]) {
                        unset($shouldHave[$hytaleGroup->getGroupName()]);
                    } else {
                        continue;
                    }
                }
                $shouldNotHave[$hytaleGroup->getGroupName()] = $userGroups[$hytaleGroup->getGroupID()]->priority;
            }
        }

        ksort($shouldHave, SORT_NUMERIC);
        ksort($shouldNotHave, SORT_NUMERIC);

        return $this->send('OK', 200, [
            'shouldHave' => $shouldHave,
            'shouldNotHave' => $shouldNotHave
        ]);
    }
}
