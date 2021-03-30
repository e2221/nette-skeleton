<?php
declare(strict_types=1);


namespace App\UserACL;

use Nette\Security\AuthenticationException;
use Nette\Security\SimpleIdentity;


class Authenticator implements \Nette\Security\Authenticator
{
    private UserACLManager $userACLManager;

    const AUTHENTICATED_ROLES = ['authenticated'];

    public function __construct(UserACLManager $userACLManager)
    {
        $this->userACLManager = $userACLManager;
    }

    function authenticate(string $username, string $password): SimpleIdentity
    {
        $user = $this->userACLManager->authorizeUser($username, $password);

        //not enabled user
        if($user->enabled === false)
            throw new AuthenticationException('User is disabled', self::FAILURE);

        $roles = $this->userACLManager->getUserRolesNames($user);
        foreach(self::AUTHENTICATED_ROLES as $role)
            if(!in_array($role, $roles))
                array_unshift($roles, $role);

        $userData = [
            'login'     => $user->login,
            'email'     => $user->email,
            'name'      => $user->name,
            'roles'     => $roles
        ];
        return new SimpleIdentity($user->id, $roles, $userData);
    }
}