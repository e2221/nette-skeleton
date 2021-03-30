<?php
declare(strict_types=1);


namespace App\UserACL;

use App\Model\UsersACL\Entity\AclRolesResourcesEntity;
use App\Model\UsersACL\Repository\AclRolesResourcesRepository;
use Nette\SmartObject;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Entity\IEntity;

class RolesResourcesACLManager
{
    use SmartObject;

    protected AclRolesResourcesRepository $repository;

    public function __construct(AclRolesResourcesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AclRolesResourcesRepository
     */
    public function getRepository(): AclRolesResourcesRepository
    {
        return $this->repository;
    }

    /**
     * Get all roles and resources
     * @return AclRolesResourcesEntity[]|ICollection
     */
    public function getAllRolesResources(): ICollection
    {
        return $this->repository->findAll();
    }

    /**
     * Get entity by id
     * @param int $id
     * @return AclRolesResourcesEntity|null
     */
    public function getRolesResourcesEntity(int $id): ?AclRolesResourcesEntity
    {
        return $this->repository->getById($id);
    }

    /**
     * Save
     * @param AclRolesResourcesEntity $entity
     * @return AclRolesResourcesEntity
     */
    public function saveRolesResourcesEntity(AclRolesResourcesEntity $entity): AclRolesResourcesEntity
    {
        return $this->repository->persistAndFlush($entity);
    }

    /**
     * Add role resource
     * @param int|null $idRole
     * @param int|null $idResource
     * @param int|null $idPrivilege
     * @return AclRolesResourcesEntity
     */
    public function addRoleResource(?int $idRole=null, ?int $idResource=null, ?int $idPrivilege=null): AclRolesResourcesEntity
    {
        $entity = new AclRolesResourcesEntity();
        $this->repository->attach($entity);
        $entity->idRole = $idRole;
        $entity->idResource = $idResource;
        $entity->idPrivilege = $idPrivilege;
        return $this->saveRolesResourcesEntity($entity);
    }

    /**
     * Remove Role resource
     * @param AclRolesResourcesEntity|int $roleResource
     * @return IEntity|null
     */
    public function removeRoleResource($roleResource): ?IEntity
    {
        if(is_numeric($roleResource))
            $roleResource = $this->getRolesResourcesEntity($roleResource);
        return $roleResource ? $this->repository->removeAndFlush($roleResource) : null;
    }
}