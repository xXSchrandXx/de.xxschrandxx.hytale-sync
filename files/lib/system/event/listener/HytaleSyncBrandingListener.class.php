<?php

namespace wcf\system\event\listener;

use wcf\system\WCF;

class HytaleSyncBrandingListener implements IParameterizedEventListener
{
    /**
     * @inheritDoc
     */
    public function execute($eventObj, $className, $eventName, array &$parameters)
    {
        if (!HYTALE_SYNC_ENABLED) {
            return;
        }
        WCF::getTPL()->assign([
            'showHytaleSyncBranding' => true
        ]);
    }
}
