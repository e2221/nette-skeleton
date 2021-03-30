<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Mapper;


use App\Model\BaseMapper;
use Nextras\Orm\Collection\ICollection;

class AclUsersMapper extends BaseMapper
{
    protected $tableName = 'acl_users';

    /**
     * Find users by ids
     * @param array $ids
     * @return ICollection
     */
    public function findUsersByIds(array $ids)
    {
        return $this->toCollection(
            $this->builder()->where('id IN %i[]', $ids)
        );
    }

    /**
     * Find users by ids - revert collection (not in list)
     * @param array $ids
     * @return ICollection
     */
    public function findUsersByIds_revert(array $ids)
    {
        if(count($ids) == 0)
            return $this->findAll();
        return $this->toCollection(
            $this->builder()->where('id NOT IN %i[]', $ids)
        );
    }
}