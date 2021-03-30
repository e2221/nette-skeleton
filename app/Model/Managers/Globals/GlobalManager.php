<?php declare(strict_types=1);


namespace App\Model\Managers;


use app\Model\Orm\ModelObjects\Globals\GlobalsEntity;
use app\Model\Orm\ModelObjects\Globals\GlobalsKeysRepository;
use app\Model\Orm\ModelObjects\Globals\GlobalsRepository;
use JetBrains\PhpStorm\ArrayShape;
use Nette\SmartObject;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Entity\IEntity;

/**
 * Class GlobalManager
 * @package App\Model\Managers
 *
 * @property-read string $brand
 * @property-read string $loginSessionStandard
 * @property-read string $loginSessionRemember
 * @property-read string $loginRoute
 * @property-read string $logoutRoute
 * @property-read string $YES_OPTION
 * @property-read string $NO_OPTION
 *
 */
class GlobalManager
{
    use SmartObject;

    public const
        BRAND                   = 'brand',
        LOGIN_SESSION_STANDARD  = 'loginSessionStandard',
        LOGIN_SESSION_REMEMBER  = 'loginSessionRemember',
        VAT_RATES               = 'VAT_RATES',
        YES_OPTION              = 'YES_OPTION',
        NO_OPTION               = 'NO_OPTION';

    public function __construct(
        private array $parameters,
        private GlobalsRepository $valuesRepository,
        private GlobalsKeysRepository $keysRepository,
    )
    {
    }

    public function __get(string $name)
    {
        if(isset($this->parameters[$name])){
            return $this->parameters[$name];
        }else{
            $value = $this->getByValueKey($name)?->value;
            return $value ? $value : null;
        }
    }

    /**
     * Get boolean selection NO - YES
     * @return mixed[]
     */
    public function getBooleanSelection(): array
    {
        return [0 => $this->NO_OPTION, 1 => $this->YES_OPTION];
    }

    /**
     * @param string $key
     * @return GlobalsEntity[]|ICollection|null
     */
    public function findByKey(string $key): ICollection|array|null
    {
        return $this->keysRepository->getBy(['globalKey' => $key])?->values->toCollection();
    }


    /**
     * @param string $key
     * @return GlobalsEntity|IEntity|null
     */
    public function getByValueKey(string $key): IEntity|GlobalsEntity|null
    {
        return $this->valuesRepository->getBy(['intKey' => $key]);
    }
}