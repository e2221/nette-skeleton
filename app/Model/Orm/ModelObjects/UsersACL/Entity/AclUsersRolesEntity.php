<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Entity;

/**
 * Class AclUsersRolesEntity
 * @package App\Model\UsersACL\Entity
 *
 * @property int                         $id         {primary}
 * @property AclUsersEntity|null         $idUser     {m:1 AclUsersEntity::$usersRoles}
 * @property AclRolesEntity|null         $idRole     {m:1 AclRolesEntity::$usersRoles}
 *
 * virtual
 * @property-read string            $userLogin      {virtual}
 * @property-read string            $roleName       {virtual}
 */
class AclUsersRolesEntity extends \App\Model\BaseEntity
{
    /**
     * Getter userLogin
     * @return string
     */
    protected function getterUserLogin(): string
    {
        return $this->idUser ? $this->idUser->login : '';
    }

    protected function getterRoleName(): string
    {
        return $this->idRole ? $this->idRole->name : '';
    }
}