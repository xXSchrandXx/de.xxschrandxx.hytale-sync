<?php

namespace wcf\data\user\group\hytale;

use wcf\data\DatabaseObjectList;

/**
 * HytaleGroup List class
 *
 * @author   xXSchrandXx
 * @package  WoltLabSuite\Core\Data\User\Group\Hytale
 */
class HytaleGroupList extends DatabaseObjectList
{
    /**
     * @inheritDoc
     */
    public $className = HytaleGroup::class;
}
