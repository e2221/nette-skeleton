<?php
declare(strict_types=1);


namespace App\UserACL;


use App\Model\Exceptions\EntityNotFoundException;
use App\Model\UsersACL\Entity\AclUsersRolesEntity;
use App\Model\UsersACL\Repository\AclUsersRolesRepository;
use Nette\Security\User;
use Nette\SmartObject;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Entity\IEntity;

class UserRolesACLManager
{
    use SmartObject;

    protected AclUsersRolesRepository $repository;

    public function __construct(AclUsersRolesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get repository
     * @return AclUsersRolesRepository
     */
    public function getRepository(): AclUsersRolesRepository
    {
        return $this->repository;
    }

    /**
     * Get UserRoles entity
     * @param int $UserRoleID
     * @return AclUsersRolesEntity|null
    */
    public function getUserRolesEntity(int $UserRoleID): ?AclUsersRolesEntity
    {
        return $this->repository->getById($UserRoleID);
    }

    /**
     * Get new entity
     * @return AclUsersRolesEntity
     */
    public function getNewEntity(): AclUsersRolesEntity
    {
        $entity = new AclUsersRolesEntity();
        $this->repository->attach($entity);
        return $entity;
    }

    /**
     * Save UserRoles entity
     * @param AclUsersRolesEntity $entity
     * @return AclUsersRolesEntity
     */
    public function saveUserRolesEntity(AclUsersRolesEntity $entity): AclUsersRolesEntity
    {
        return $this->repository->persistAndFlush($entity);
    }

    /**
     * Get users roles
     * @param array|null $filter
     * @return AclUsersRolesEntity[]|ICollection
     */
    public function getUsersRoles(?array $filter=null): ICollection
    {
        if(is_null($filter))
            return $this->repository->findAll();
        return $this->repository->findBy($filter);
    }

    /**
     * Remove entity
     * @param $entity
     * @return IEntity
     * @throws EntityNotFoundException
    */
    public function removeEntity($entity): IEntity
    {
        if(is_numeric($entity))
            $entity = $this->getUserRolesEntity($entity);
        if(!$entity)
            throw new EntityNotFoundException('Entity was not found');
        return $this->repository->removeAndFlush($entity);
    }

    /**
     * Get user roles by user
     * @param int $userID
     * @return ICollection|null
     */
    public function getUserRolesByUser(int $userID): ?ICollection
    {
        return $this->getUsersRoles(['idUser' => $userID]);
    }



}