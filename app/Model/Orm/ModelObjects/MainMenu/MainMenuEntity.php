<?php


namespace App\Model\MainMenu;


use App\Model\BaseEntity;
use App\Model\UsersACL\Entity\AclResourcesEntity;
use Nette\DI\Attributes\Inject;
use Nette\Security\User;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Class MainMenuEntity
 * @property int                                $id                 {primary}
 * @property MainMenuEntity|null                $parent             {m:1 MainMenuEntity::$children}
 * @property OneHasMany|MainMenuEntity[]|null   $children           {1:m MainMenuEntity::$parent}
 * @property string|null                        $title
 * @property string|null                        $description
 * @property bool                               $enabled
 * @property int                                $rank
 * @property string                             $url
 * @property AclResourcesEntity|null            $acl                {m:1 AclResourcesEntity::$menu}
 * @property-read bool                          $isAllowedViewForMe {virtual}
 */
class MainMenuEntity extends BaseEntity
{
    #[Inject]
    public User $user;

    /**
     * @return bool
     */
    protected function getterIsAllowedViewForMe(): bool
    {
        if(is_null($this->acl))
            return false;
        return $this->user->isAllowed($this->acl->name, 'read');
    }
}