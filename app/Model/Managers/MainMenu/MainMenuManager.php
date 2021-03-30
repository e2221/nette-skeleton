<?php declare(strict_types=1);


namespace App\Model\Managers\MainMenu;


use App\Model\MainMenu\MainMenuEntity;
use App\Model\MainMenu\MainMenuRepository;
use Nette\SmartObject;

class MainMenuManager
{
    use SmartObject;

    public function __construct(private MainMenuRepository $menuRepository)
    {
    }

    /**
     * @return MainMenuRepository
     */
    public function getMenuRepository(): MainMenuRepository
    {
        return $this->menuRepository;
    }

    /**
     * Get menu items
     * @return MainMenuEntity[]
     */
    public function getMenuItems(): array
    {
        $menu  = [];
        $selection =  $this->menuRepository->findBy(['parent' => null])
            ->orderBy('rank');

        foreach($selection as $key => $menuEntity)
        {
            if($menuEntity->isAllowedViewForMe === false)
                continue;
            $menu[$key] = $menuEntity;
        }

        return $menu;
    }

}