<?php declare(strict_types=1);


namespace App\BackendModule\Presenters;


use App\UI\BackendModule\Components\LoginForm\LoginForm;
use App\UI\BackendModule\Components\LoginForm\LoginFormFactory;
use JetBrains\PhpStorm\NoReturn;
use Nittro\Bridges\NittroUI\Presenter;

class LoginPresenter extends Presenter
{

    public function __construct(
        private LoginFormFactory $loginFormFactory
    )
    {
        parent::__construct();
    }

    public function actionLogout(): void
    {
        $this->user->logout();
        $this->redirect('default');
    }

    /**
     * @return LoginForm
     */
    protected function createComponentSignInForm(): LoginForm
    {
        $onSuccess = function(){
            $this->redirect('Homepage:default');
        };

        return $this->loginFormFactory->create($onSuccess);
    }

}