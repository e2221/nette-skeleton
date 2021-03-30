<?php declare(strict_types=1);


namespace App\UI\BackendModule\Presenters;


use App\BackendModule\Components\MainMenu\MainMenu;
use App\Model\Managers\GlobalManager;
use App\Model\Managers\MainMenu\IMainMenuFactory;
use Nette\DI\Attributes\Inject;
use Nittro\Bridges\NittroUI\Presenter;

class BasePresenter extends Presenter
{
    #[Inject]
    public IMainMenuFactory $mainMenuFactory;

    #[Inject]
    public GlobalManager $globalManager;

    /**
     * Startup
     */
    protected function startup()
    {
        parent::startup();
        if($this->user->isLoggedIn() === false)
            $this->redirect($this->globalManager->loginRoute);
    }

    /**
     * @return MainMenu
     */
    protected function createComponentMainMenu(): MainMenu
    {
        return $this->mainMenuFactory->create()
            ->setBrand($this->getBrand())
            ->setLogInLink($this->link($this->globalManager->loginRoute))
            ->setLogoutLink($this->link($this->globalManager->logoutRoute));
    }

    /**
     * @return string|null
     */
    private function getBrand(): ?string
    {
        return $this->globalManager->brand;
    }

}