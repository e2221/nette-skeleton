<?php
declare(strict_types=1);


namespace App\UserACL;


use Nette\Security\Permission;

class AuthorizationFactory
{
    public static function create(UserACLFacade $userACLFacade): Permission
    {
        $acl = new Permission();

        //add all roles
        foreach($userACLFacade->getRolesACLManager()->getAllRoles() as $roleKey => $role)
            if((!is_null($role->name) || !empty($role->name)) && !in_array($role->name, $acl->getRoles())){

                $acl->addRole($role->name, $role->parentId ? $role->parentId->name : null);
            }

        //add all resourcesd
        foreach($userACLFacade->getResourcesACLManager()->getAllResources() as $resourceKey => $resource)
        {
            $acl->addResource($resource->name);
        }

        //add all allows
        foreach($userACLFacade->getRolesResourcesACLManager()->getAllRolesResources() as $rolesResourceKey => $rolesResourcesEntity)
        {
            $acl->allow($rolesResourcesEntity->roleName, $rolesResourcesEntity->resourceName, $rolesResourcesEntity->privilegeType);
        }

        // grant all access to admins
        foreach($userACLFacade->getRolesACLManager()->getAdminRoles() as $roleKey => $adminRole)
            $acl->allow($adminRole->name, $acl::ALL, $acl::ALL);

        //custom privileges

        return $acl;
    }
}