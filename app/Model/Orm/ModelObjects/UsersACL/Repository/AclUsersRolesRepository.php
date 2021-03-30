<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Repository;


use App\Model\UsersACL\Entity\AclUsersRolesEntity;

class AclUsersRolesRepository extends \App\Model\BaseRepository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [AclUsersRolesEntity::class];
    }
}