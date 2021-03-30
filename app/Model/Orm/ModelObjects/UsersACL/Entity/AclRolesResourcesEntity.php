<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Entity;

/**
 * Class AclRolesResourcesEntity
 * @package App\Model\UsersACL\Entity
 *
 * @property int                        $id             {primary}
 * @property AclRolesEntity|null        $idRole         {m:1 AclRolesEntity::$rolesResources}
 * @property AclResourcesEntity|null    $idResource     {m:1 AclResourcesEntity::$rolesResources}
 * @property AclPrivilegesEntity|null   $idPrivilege    {m:1 AclPrivilegesEntity::$rolesResources}
 *
 * virtual
 * @property-read string|null                $roleName          {virtual}
 * @property-read string|null                $resourceName      {virtual}
 * @property-read string|null                $privilegeType     {virtual}
 */
class AclRolesResourcesEntity extends \App\Model\BaseEntity
{
    protected function getterRoleName(): ?string
    {
        if(is_null($this->idRole))
            return null;
        return $this->idRole->name;
    }

    protected function getterResourceName(): ?string
    {
        if(is_null($this->idResource))
            return null;
        return $this->idResource->name;
    }

    protected function getterPrivilegeType(): ?string
    {
        if(is_null($this->idPrivilege))
            return null;
        return $this->idPrivilege->privilege;
    }
}