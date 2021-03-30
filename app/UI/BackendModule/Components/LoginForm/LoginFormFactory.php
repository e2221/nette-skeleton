<?php declare(strict_types=1);


namespace App\UI\BackendModule\Components\LoginForm;


use App\Model\Managers\GlobalManager;
use Nette\Security\User;

class LoginFormFactory
{
    public function __construct(
        private User $user,
        private GlobalManager $globalManager,
    )
    {
    }

    /**
     * Create
     * @param callable|null $onSuccess
     * @return LoginForm
     */
    public function create(callable|null $onSuccess=null): LoginForm
    {
        return new LoginForm($onSuccess, $this->user, $this->globalManager);
    }
}