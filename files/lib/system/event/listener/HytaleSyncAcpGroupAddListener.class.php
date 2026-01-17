<?php

namespace wcf\system\event\listener;

use wcf\data\hytale\HytaleList;
use wcf\data\user\group\hytale\HytaleGroupList;
use wcf\system\WCF;
use wcf\util\StringUtil;

class HytaleSyncAcpGroupAddListener implements IParameterizedEventListener
{
    /**
     * @inheritDoc
     * @param \wcf\acp\form\UserGroupEditForm $eventObj
     */
    public function execute($eventObj, $className, $eventName, array &$parameters)
    {
        if (!(HYTALE_SYNC_ENABLED && HYTALE_LINKER_ENABLED && HYTALE_SYNC_IDENTITY)) {
            return;
        }
        if (!WCF::getSession()->getPermission('admin.hytaleSync.canManage')) {
            return;
        }
        if (!($eventObj instanceof \wcf\acp\form\UserGroupEditForm)) {
            return;
        }

        $hytaleList = new HytaleList();
        $hytaleList->setObjectIDs(explode("\n", StringUtil::unifyNewlines(HYTALE_SYNC_IDENTITY)));
        $hytaleList->readObjects();
        $hytales = $hytaleList->getObjects();

        /** @var \wcf\data\user\group\hytale\HytaleGroup[] */
        $hytaleGroups = [];
        foreach ($hytales as $hytaleID => $hytale) {
            $hytaleGroupList = new HytaleGroupList();
            $hytaleGroupList->getConditionBuilder()->add('groupID = ? AND hytaleID = ?', [$eventObj->groupID, $hytaleID]);
            $hytaleGroupList->readObjects();
            $hytaleGroups[$hytaleID] = $hytaleGroupList->getObjects();
        }

        WCF::getTPL()->assign(
            [
                'groupID' => $eventObj->groupID,
                'hytales' => $hytales,
                'hytaleGroups' => $hytaleGroups
            ]
        );
    }
}
