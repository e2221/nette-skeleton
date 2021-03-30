<?php
declare(strict_types=1);


namespace App\UserACL;


use Nette\SmartObject;

class UserACLFacade
{
    use SmartObject;

    protected UserACLManager $userACLManager;
    protected RolesACLManager $rolesACLManager;
    protected ResourcesACLManager $resourcesACLManager;
    protected PrivilegesACLManager $privilegesACLManager;
    protected RolesResourcesACLManager $rolesResourcesACLManager;
    protected UserRolesACLManager $userRolesACLManager;

    public function __construct(
        UserACLManager $userACLManager,
        RolesACLManager $rolesACLManager,
        ResourcesACLManager $resourcesACLManager,
        PrivilegesACLManager $privilegesACLManager,
        RolesResourcesACLManager $rolesResourcesACLManager,
        UserRolesACLManager $userRolesACLManager,
    )
    {
        $this->userACLManager = $userACLManager;
        $this->rolesACLManager = $rolesACLManager;
        $this->resourcesACLManager = $resourcesACLManager;
        $this->privilegesACLManager = $privilegesACLManager;
        $this->rolesResourcesACLManager = $rolesResourcesACLManager;
        $this->userRolesACLManager = $userRolesACLManager;
    }

    /**
     * @return UserRolesACLManager
     */
    public function getUserRolesACLManager(): UserRolesACLManager
    {
        return $this->userRolesACLManager;
    }

    /**
     * @return UserACLManager
     */
    public function getUserACLManager(): UserACLManager
    {
        return $this->userACLManager;
    }

    /**
     * @return RolesACLManager
     */
    public function getRolesACLManager(): RolesACLManager
    {
        return $this->rolesACLManager;
    }

    /**
     * @return ResourcesACLManager
     */
    public function getResourcesACLManager(): ResourcesACLManager
    {
        return $this->resourcesACLManager;
    }

    /**
     * @return PrivilegesACLManager
     */
    public function getPrivilegesACLManager(): PrivilegesACLManager
    {
        return $this->privilegesACLManager;
    }

    /**
     * @return RolesResourcesACLManager
     */
    public function getRolesResourcesACLManager(): RolesResourcesACLManager
    {
        return $this->rolesResourcesACLManager;
    }


}