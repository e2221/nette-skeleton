<?php


namespace App\Model\MainMenu;


use App\Model\MainMenu\MainMenuEntity;
use Nextras\Orm\Collection\ICollection;

class MainMenuRepository extends \Nextras\Orm\Repository\Repository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [MainMenuEntity::class];
    }

    /**
     * Get menu items
     * @param int|null $parent
     * @return ICollection
     */
    public function getMenuItems(?int $parent=null): ICollection
    {
        return $this->findBy(['parent' => $parent]);
    }
}