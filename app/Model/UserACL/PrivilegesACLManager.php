<?php
declare(strict_types=1);


namespace App\UserACL;


use App\Model\UsersACL\Entity\AclPrivilegesEntity;
use App\Model\UsersACL\Repository\AclPrivilegesRepository;
use Nette\SmartObject;
use Nextras\Orm\Collection\ICollection;

class PrivilegesACLManager
{
    use SmartObject;

    protected AclPrivilegesRepository $repository;

    public function __construct(AclPrivilegesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AclPrivilegesRepository
     */
    public function getRepository(): AclPrivilegesRepository
    {
        return $this->repository;
    }

    /**
     * @return AclPrivilegesEntity[]|ICollection
     */
    public function getAllPrivileges(): ICollection
    {
        return $this->repository->findAll();
    }

    /**
     * Get privileges selection
     * @return array
     */
    public function getPrivilegesSelection(): array
    {
        return $this->getAllPrivileges()->fetchPairs('id', 'privilege');
    }
}