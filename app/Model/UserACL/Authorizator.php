<?php
declare(strict_types=1);

namespace App\UserACL;


use Nette\Security\User;

class Authorizator implements \Nette\Security\Authorizator
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function isAllowed($role, $resource, $privilege): bool
    {


        return false;
    }
}