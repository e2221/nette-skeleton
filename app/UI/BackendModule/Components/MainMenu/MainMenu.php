<?php declare(strict_types=1);


namespace App\BackendModule\Components\MainMenu;


use App\Model\MainMenu\MainMenuEntity;
use App\Model\Managers\MainMenu\MainMenuManager;
use App\UI\BackendModule\Components\BaseControl;
use Nextras\Orm\Collection\ICollection;

class MainMenu extends BaseControl
{
    /** @var string|null Brand */
    protected ?string $brand=null;

    /** @var string|null Login link */
    protected ?string $logInLink=null;

    /** @var string|null  */
    protected ?string $logoutLink=null;

    /** @var string|null sidebar toggle */
    protected ?string $sidebarToggleId=null;

    public function __construct(private MainMenuManager $mainMenuManager)
    {
    }


    /**
     * @param string|null $brand
     * @return MainMenu
     */
    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @param string|null $logInLink
     * @return MainMenu
     */
    public function setLogInLink(?string $logInLink): self
    {
        $this->logInLink = $logInLink;
        return $this;
    }

    /**
     * @param string|null $logoutLink
     * @return MainMenu
     */
    public function setLogoutLink(?string $logoutLink): self
    {
        $this->logoutLink = $logoutLink;
        return $this;
    }

    /**
    * Renderer
    */
    public function render(): void
    {
        $this->template->loginLink = $this->logInLink;
        $this->template->logoutLink = $this->logoutLink;
        $this->template->brand = $this->brand;
        $this->template->menu = $this->mainMenuManager->getMenuItems();
        $this->template->setFile(__DIR__ . '/templates/default.latte');
        $this->template->render();
    }


}

/**
 * Template
 * @method mixed clamp($value, $min, $max)
 */
class MainMenuTemplate extends \Nette\Bridges\ApplicationLatte\Template
{
    use \Nette\SmartObject;
    public MainMenu $control;
    public \Nette\Security\User $user;
    public string $baseUrl;
    public string $basePath;
    public array $flashes;
    public ?string $brand;
    public ?string $loginLink;
    public ?string $logoutLink;

    /** @var MainMenuEntity[]|ICollection  */
    public array|ICollection $menu;
}