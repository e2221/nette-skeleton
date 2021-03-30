<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Entity;

use App\Model\MainMenu\MainMenuEntity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Class AclResourcesEntity
 * @package App\Model\UsersACL\Entity
 *
 * @property int                                $id             {primary}
 * @property string                             $name
 * @property string|null                        $description    {default null}
 *
 * @property OneHasMany|AclRolesResourcesEntity[]   $rolesResources     {1:m AclRolesResourcesEntity::$idResource}
 * @property OneHasMany|MainMenuEntity[]            $menu                {1:m MainMenuEntity::$acl}
 */
class AclResourcesEntity extends \App\Model\BaseEntity
{

}