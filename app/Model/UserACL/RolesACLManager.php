<?php
declare(strict_types=1);


namespace App\UserACL;


use App\Model\Exceptions\EntityNotFoundException;
use App\Model\UsersACL\Entity\AclRolesEntity;
use App\Model\UsersACL\Repository\AclRolesRepository;
use Exception;
use Nette\SmartObject;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Entity\IEntity;

class RolesACLManager
{
    use SmartObject;

    protected AclRolesRepository $repository;
    private UserRolesACLManager $userRolesACLManager;

    public function __construct(AclRolesRepository $repository, UserRolesACLManager $userRolesACLManager)
    {
        $this->repository = $repository;
        $this->userRolesACLManager = $userRolesACLManager;
    }

    /**
     * @return AclRolesRepository
     */
    public function getRepository(): AclRolesRepository
    {
        return $this->repository;
    }

    /**
     * Get all roles
     * @return AclRolesEntity[]|ICollection
     */
    public function getAllRoles(): ICollection
    {
        return $this->repository->findAll()->orderBy('id');
    }

    /**
     * Get admin roles
     * @return ICollection
     */
    public final function getAdminRoles(): ICollection
    {
        return $this->repository->findBy(['admin' => true]);
    }

    /**
     * Get roles entity
     * @param int $id
     * @return AclRolesEntity|null
     */
    public function getRolesEntity(int $id): ?AclRolesEntity
    {
        return $this->repository->getById($id);
    }

    /**
     * Save Role entity
     * @param AclRolesEntity $entity
     * @return AclRolesEntity
     * @throws Exception
     */
    public function saveRolesEntity(AclRolesEntity $entity): AclRolesEntity
    {
        if($entity->editable)
        {
            if($this->repository->findBy(['name' => $entity->name]))
            return $this->repository->persistAndFlush($entity);
        }
        throw new Exception('Editing default roles is not possible! Contact your system administration.');
    }

    /**
     * Remove entity
     * @param $role
     * @return IEntity
     * @throws EntityNotFoundException
    */
    public function removeEntity($role): IEntity
    {
        if(is_numeric($role))
            $role = $this->getRolesEntity($role);
        if(!$role)
            throw new EntityNotFoundException('Entity was not found');
        return $this->repository->removeAndFlush($role);
    }

    /**
     * Add Role
     * @param string $roleName
     * @param int|null $parentID
     * @return AclRolesEntity
     */
    public function addRole(string $roleName='Role', ?int $parentID=null): AclRolesEntity
    {
        $entity = new AclRolesEntity();
        $this->repository->attach($entity);
        $entity->name = $roleName;
        $entity->parentId = $parentID;
        return $this->repository->persistAndFlush($entity);
    }

    /**
     * Check if role name already exists in the database 2 or more times
     * @param string $role
     * @return bool
     */
    public function checkIfRoleExistsOnlyOneTime(string $role): bool
    {
        return $this->getAllRoles()->findBy(['name' => $role])->count() > 1;
    }

    /**
     * Get roles selections
     * @param int|null $excludeUserID
     * @return array
     */
    public function getRolesSelection(?int $excludeUserID=null): array
    {
        $all = $this->repository->findAll()->fetchPairs('id', 'name');
        if($excludeUserID)
        {
            $excludeList = $this->userRolesACLManager->getUserRolesByUser($excludeUserID)->fetchPairs('id', 'idRole');
            foreach($excludeList as $userKey => $id)
            {
                if(array_key_exists($id->id, $all))
                    unset($all[$id->id]);
            }
        }
        return $all;
    }

    /**
     * Get roles exclude by user
     * @param int $excludeUserID
     * @return AclRolesEntity[]|ICollection
     */
    public function getRolesExcludeByUser(int $excludeUserID)
    {
        $keys = [];
        $excludeList = $this->userRolesACLManager->getUserRolesByUser($excludeUserID)->fetchAll();
        if(count($excludeList))
        {
            foreach($excludeList as $key => $excludeItem)
                $keys[] = (string)$excludeItem->idRole->id;
            return $this->repository->getRolesExcludeList(array_values($keys));
        }
        return $this->getAllRoles();
    }


}