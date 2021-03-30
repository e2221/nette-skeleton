<?php
declare(strict_types=1);


namespace App\Model\UsersACL\Mapper;


use App\Model\BaseMapper;
use Nextras\Dbal\QueryException;
use Nextras\Orm\Collection\ICollection;

class AclRolesMapper extends BaseMapper
{
    protected $tableName = 'acl_roles';

    /**
     * @param array $exclude
     * @return ICollection
     * @throws QueryException
     */
    public function getRolesExcludeList(array $exclude): ICollection
    {
        return $this->toCollection(
            $this->connection->query(/** @lang text */ "SELECT * FROM acl_roles WHERE id NOT IN %s[]", $exclude)
        );
    }
}