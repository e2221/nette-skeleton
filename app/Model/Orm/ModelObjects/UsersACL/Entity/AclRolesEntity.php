<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Entity;

use Nextras\Orm\Relationships\OneHasMany;

/**
 * Class AclRolesEntity
 * @package App\Model\UsersACL\Entity
 *
 * @property int                            $id         {primary}
 * @property AclRolesEntity|null            $parentId   {m:1 AclRolesEntity::$roles}
 * @property OneHasMany|AclRolesEntity[]    $roles      {1:m AclRolesEntity::$parentId}
 * @property string|null                    $name       {default null}
 * @property bool                           $editable   {default true}
 * @property bool                           $admin      {default false}
 *
 * relations
 * @property OneHasMany|AclRolesResourcesEntity[]   $rolesResources     {1:m AclRolesResourcesEntity::$idRole, cascade=[persist,remove]}
 * @property OneHasMany|AclUsersRolesEntity[]       $usersRoles         {1:m AclUsersRolesEntity::$idRole, cascade=[persist,remove]}
 *
 * virtual
 * @property-read string                    $parentName     {virtual}
 * @property-read int|null                  $parent         {virtual}
 */
class AclRolesEntity extends \App\Model\BaseEntity
{

    protected function setterParentId(?int $parent=null): void
    {
        if($parent == 0)
            $parent = null;
        $this->parentId = $parent;
    }

    protected function getterParent(): ?int
    {
        if(is_null($this->parentId))
            return null;
        return $this->parentId->id;
    }

    protected function getterParentName(): string
    {
        return $this->parentId ? $this->parentId->name : '';
    }
}