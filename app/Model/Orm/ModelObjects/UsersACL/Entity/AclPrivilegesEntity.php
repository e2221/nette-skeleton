<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Entity;

use App\Model\ModelObjects\Sharing\Objects\SharingObjectEntity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Class AclPrivilegesEntity
 * @package App\Model\UsersACL\Entity
 *
 * @property int                $id             {primary}
 * @property string             $privilege
 * @property string|null        $description    {default null}
 *
 * @property AclRolesResourcesEntity[]|OneHasMany       $rolesResources     {1:m AclRolesResourcesEntity::$idPrivilege}
 */
class AclPrivilegesEntity extends \App\Model\BaseEntity
{

}