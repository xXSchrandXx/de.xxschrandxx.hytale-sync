<?php

namespace wcf\data\user\group\hytale;

use wcf\data\DatabaseObjectEditor;

/**
 * HytaleGroup Editor class
 *
 * @author   xXSchrandXx
 * @package  WoltLabSuite\Core\Data\User\Group\Hytale
 */
class HytaleGroupEditor extends DatabaseObjectEditor
{
    /**
     * @inheritDoc
     */
    protected static $baseClass = HytaleGroup::class;
}
