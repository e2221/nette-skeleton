<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Repository;


use App\Model\UsersACL\Entity\AclUsersEntity;
use Nextras\Orm\Collection\ICollection;

/**
 * Class AclUsersRepository
 * @method ICollection|AclUsersEntity[] findUsersByIds($ids)
 * @method ICollection|AclUsersEntity[] findUsersByIds_revert($ids)
 */
class AclUsersRepository extends \App\Model\BaseRepository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [AclUsersEntity::class];
    }
}