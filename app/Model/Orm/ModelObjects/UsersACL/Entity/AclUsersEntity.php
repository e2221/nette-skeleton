<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Entity;

use App\Model\BaseEntity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Class AclUsersEntity
 *
 * @property int                                $id             {primary}
 * @property string                             $login
 * @property string|null                        $password       {default null}
 * @property string|null                        $email          {default null}
 * @property string|null                        $name           {default null}
 * @property bool                               $enabled        {default true}
 *
 * keys
 * @property OneHasMany|AclUsersRolesEntity[]   $usersRoles     {1:m AclUsersRolesEntity::$idUser, cascade=[persist, remove]}


 *
 * virtual
 * @property-read AclRolesEntity[] $roles       {virtual}
 */
class AclUsersEntity extends BaseEntity
{
    /**
     * @return AclRolesEntity[]
     */
    protected function getterRoles(): array
    {
        $roles = [];
        foreach ($this->usersRoles as $userRoleKey => $userRole)
            $roles[] = $userRole->idRole;
        return $roles;
    }

}