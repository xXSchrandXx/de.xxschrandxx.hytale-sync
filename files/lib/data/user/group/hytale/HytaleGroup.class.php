<?php

namespace wcf\data\user\group\hytale;

use wcf\data\DatabaseObject;

/**
 * HytaleGroup Data class
 *
 * @author   xXSchrandXx
 * @package  WoltLabSuite\Core\Data\User\Group\Hytale
 *
 * @property-read int $hytaleGroupID
 * @property-read int $groupID
 * @property-read int $hytaleID
 * @property-read string $hytaleName
 * @property-read boolean $shouldHave
 */
class HytaleGroup extends DatabaseObject
{
    /**
     * @inheritDoc
     */
    protected static $databaseTableName = 'hytale_group';

    /**
     * @inheritDoc
     */
    protected static $databaseTableIndexName = 'hytaleGroupID';

    /**
     * Returns group name
     * @return ?string
     */
    public function getGroupName()
    {
        return $this->hytaleName;
    }

    /**
     * Returns weather the user should have this group on hytale server
     * @return ?bool
     */
    public function getShouldHave()
    {
        return $this->shouldHave;
    }

    /**
     * Returns hytaleID
     * @return ?int
     */
    public function getHytaleID()
    {
        return $this->hytaleID;
    }


    /**
     * Returns groupID
     * @return ?int
     */
    public function getGroupID()
    {
        return $this->groupID;
    }
}
