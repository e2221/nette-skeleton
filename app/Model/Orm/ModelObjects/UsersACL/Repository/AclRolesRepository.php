<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Repository;


use App\Model\UsersACL\Entity\AclRolesEntity;
use Nextras\Orm\Collection\ICollection;

/**
 * Class AclRolesRepository
 * @method ICollection|AclRolesEntity[] getRolesExcludeList(array $exclude)
 */
class AclRolesRepository extends \App\Model\BaseRepository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [AclRolesEntity::class];
    }
}