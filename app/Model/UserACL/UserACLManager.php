<?php
declare(strict_types=1);


namespace App\UserACL;

use App\Model\User\UserApps\UserAppsEntity;
use App\Model\UsersACL\Entity\AclRolesEntity;
use App\Model\UsersACL\Entity\AclUsersEntity;
use App\Model\UsersACL\Repository\AclUsersRepository;
use Exception;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Passwords;
use Nette\SmartObject;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Entity\IEntity;
use Nextras\Orm\Relationships\OneHasMany;


class UserACLManager
{
    use SmartObject;

    private AclUsersRepository $repository;
    private Passwords $passwords;

    public function __construct(AclUsersRepository $repository, Passwords $passwords)
    {
        $this->repository = $repository;
        $this->passwords = $passwords;
    }

    public function getRepository(): AclUsersRepository
    {
        return $this->repository;
    }

    /**
     * Get user entity
     * @param int $userID
     * @return AclUsersEntity|null
     */
    public function getUserEntity(int $userID): ?AclUsersEntity
    {
        return $this->repository->getById($userID);
    }

    /**
     * @param array|null $filter
     * @param bool $includeDisabled
     * @return AclUsersEntity[]|ICollection
     */
    public function getUsersCollection(?array $filter=null, bool $includeDisabled=false): ICollection
    {
        if($includeDisabled === false)
            $filter['enabled'] = true;
        if(is_null($filter))
            return $this->repository->findAll();
        return $this->repository->findBy($filter);
    }

    /**
     * Get users selection
     * @param string|null $key
     * @param string|null $value
     * @param array|null $filter
     * @param bool $includeDisabled
     * @return array
     */
    public function getUsersSelection(string $key='id', ?string $value=null, ?array $filter=null, bool $includeDisabled=false)
    {
        return $this->getUsersCollection($filter, $includeDisabled)->fetchPairs($key, $value);
    }

    /**
     * Save entity
     * @param AclUsersEntity $entity
     * @param bool $hashPassword
     * @return AclUsersEntity
     */
    public function saveUserEntity(AclUsersEntity $entity, bool $hashPassword=false): AclUsersEntity
    {
        if($hashPassword)
            $entity->password = $this->hashPassword($entity->password);
        return $this->repository->persistAndFlush($entity);
    }

    /**
     * Get new entity
     * @return AclUsersEntity
     */
    protected function getNewEntity(): AclUsersEntity
    {
        $entity = new AclUsersEntity();
        $this->repository->attach($entity);
        return $entity;
    }

    /**
     * Add new user
     * @param $values
     * @return AclUsersEntity
     * @throws Exception
     */
    public function addNewUser($values): AclUsersEntity
    {
        if($this->repository->getBy(['login' => $values['login']]))
            throw new Exception(sprintf('User with login %s already exists!', $values['login']));
        $entity = $this->getNewEntity();
        $values->password = $this->hashPassword($values->password);
        $entity->setValues($values);
        $entity = $this->repository->persistAndFlush($entity);
        return $entity;
    }

    /**
     * Hash Password
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return $this->passwords->hash($password);
    }

    /**
     * @param string $userName
     * @param string $password
     * @return AclUsersEntity
     * @throws AuthenticationException
     */
    public function authorizeUser(string $userName, string $password): AclUsersEntity
    {
        $user = $this->repository->findBy(['login' => $userName])->fetch();
        if (is_null($user)) {
            throw new AuthenticationException('The username is incorrect.', IAuthenticator::IDENTITY_NOT_FOUND);
        } elseif (!$this->passwords->verify($password, $user->password)) {
            throw new AuthenticationException('The password is incorrect.', IAuthenticator::INVALID_CREDENTIAL);
        } elseif ($this->passwords->needsRehash($user->password)) {
            $user->password = $this->hashPassword($password);
            $this->saveUserEntity($user);
        }
        return $user;
    }

    /**
     * Array of roles entity
     * @param AclUsersEntity $entity
     * @return AclRolesEntity[]
     */
    public function getUserRoles(AclUsersEntity $entity): array
    {
        return $entity->roles;
    }

    /**
     * User roles names
     * @param AclUsersEntity $entity
     * @return array
     */
    public function getUserRolesNames(AclUsersEntity $entity): array
    {
        $roles = [];
        foreach($this->getUserRoles($entity) as $roleKey => $role)
            $roles[] = $role->name;
        return $roles;
    }

    /**
     * Enable or Disable user (not delete)
     * @param AclUsersEntity $entity
     * @param bool $enable
     * @return AclUsersEntity
     */
    public function enableUser(AclUsersEntity $entity, bool $enable=true): AclUsersEntity
    {
        $entity->enabled = $enable;
        return $this->saveUserEntity($entity);
    }

    /**
     * Remove user
     * @param AclUsersEntity $entity
     * @return IEntity
     */
    public function deleteUser(AclUsersEntity $entity): IEntity
    {
        return $this->repository->removeAndFlush($entity);
    }

    /**
     * @param int $userID
     * @return UserAppsEntity[]|OneHasMany
     */
    public function getSavedUserApplications(int $userID)
    {
        return $this->repository->getById($userID)
            ->userApps;
    }

}