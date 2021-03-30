<?php
declare(strict_types=1);


namespace App\UserACL;

use App\Model\UsersACL\Entity\AclResourcesEntity;
use App\Model\UsersACL\Repository\AclResourcesRepository;
use Nextras\Orm\Collection\ICollection;

class ResourcesACLManager
{
    protected AclResourcesRepository $repository;

    public function __construct(AclResourcesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AclResourcesRepository
     */
    public function getRepository(): AclResourcesRepository
    {
        return $this->repository;
    }

    /**
     * Get new attached entity
     * @return AclResourcesEntity
     */
    private function getNewAttachedEntity(): AclResourcesEntity
    {
        $resource = new AclResourcesEntity();
        $this->repository->attach($resource);
        return $resource;
    }

    /**
     * Get new entity
     * @return AclResourcesEntity
     */
    public function getNewEntity(): AclResourcesEntity
    {
        return $this->getNewAttachedEntity();
    }

    /**
     * Get Resources entity
     * @param int $ResourcesID
     * @return AclResourcesEntity|null
    */
    public function getResourcesEntity(int $ResourcesID): ?AclResourcesEntity
    {
        return $this->repository->getById($ResourcesID);
    }

    /**
     * Get all resources
     * @return AclResourcesEntity[]|ICollection
     */
    public function getAllResources(): ICollection
    {
        return $this->repository->findAll();
    }

    /**
     * Save Resources entity
     * @param AclResourcesEntity $entity
     * @return AclResourcesEntity
     */
    public function saveResourcesEntity(AclResourcesEntity $entity): AclResourcesEntity
    {
        return $this->repository->persistAndFlush($entity);
    }

    /**
     * Get resources selection
     * @param bool $addPrompt
     * @param string $prompt
     * @return array
     */
    public function getResourcesSelection(bool $addPrompt=false, string $prompt='...'): array
    {
        $resources = $this->getAllResources()->fetchPairs('id', 'name');
        if($addPrompt)
            array_unshift($resources, $prompt);
        return $resources;
    }
}