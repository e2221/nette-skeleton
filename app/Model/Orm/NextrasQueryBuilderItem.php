<?php
declare(strict_types=1);

namespace App\Model;

use Nextras\Dbal\Exception\InvalidArgumentException;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\IRepository;

class NextrasQueryBuilderItem
{
    /** @var IRepository|ICollection  */
    public ICollection|IRepository $repository;

    /** @var string Internal Operator (AND, OR) */
    public string $internalOperator = ICollection::AND;

    /** @var string|null Collection function for strings */
    public ?string $stringCollectionFunction = null;

    /** @var string|null Collection function for integers */
    public ?string $integersCollectionFunction = null;

    /** @var string|null Collection function for DateTimeImmutable */
    public ?string $dateTimeCollectionFunction = null;

    /** @var array Array of parameters to build query */
    public array $parameters = [];

    private NextrasQueryBuilder $nextrasQueryBuilder;


    /**
     * FindBuilderItem constructor.
     * @param NextrasQueryBuilder $nextrasQueryBuilder
     * @param IRepository $repository
     * @param array $parameters
     * @param string $operatorInternal
     */
    public function __construct(NextrasQueryBuilder $nextrasQueryBuilder, IRepository $repository, array $parameters, string $operatorInternal=ICollection::AND)
    {
        $this->nextrasQueryBuilder = $nextrasQueryBuilder;
        $this->repository = $repository;
        $this->parameters = $parameters;
        $this->internalOperator = $operatorInternal;
    }

    /**
     * Find set generator
     * @return mixed[]|null
     * @internal
     */
    public function getFindSet(): ?array
    {
        if(count($this->parameters) == 0)
            return null;

        $set = [];
        $set[] = $this->internalOperator;

        foreach($this->parameters as $key => $value)
        {
            $value = is_array($value) ? (string)$value[0] : (string)$value;
            $collectionFunction = $this->getCollectionFunction($key);
            if(is_null($collectionFunction))
            {
                $part = [$key => $value];
            }else{
                $part = [$collectionFunction, $key, $value];
            }
            $set[] = $part;
        }
        return $set;
    }

    /**
     * Returns collection function
     * @param $key
     * @return string|null
     */
    private function getCollectionFunction($key): ?string
    {
        $type = $this->getPropertyType($key);
        return match ($type) {
            'string' => $this->stringCollectionFunction,
            'int' => $this->integersCollectionFunction,
            'DateTimeImmutable' => $this->dateTimeCollectionFunction,
            default => null,
        };
    }

    /**
     * Returns property type (int, string, datetimeimmutable)
     * @param mixed $key
     * @return string|null
     */
    private function getPropertyType(mixed $key): ?string
    {
        try {
            return array_key_first($this->repository->getEntityMetadata()->getProperty($key)->types);
        }catch (InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * Set string collection function
     * @param string|null $stringCollectionFunction
     * @return NextrasQueryBuilderItem
     */
    public function setStringCollectionFunction(?string $stringCollectionFunction): NextrasQueryBuilderItem
    {
        $this->stringCollectionFunction = $stringCollectionFunction;
        return $this;
    }

    /**
     * Set int collection function
     * @param string|null $integersCollectionFunction
     * @return NextrasQueryBuilderItem
     */
    public function setIntegersCollectionFunction(?string $integersCollectionFunction): NextrasQueryBuilderItem
    {
        $this->integersCollectionFunction = $integersCollectionFunction;
        return $this;
    }

    /**
     * Set DateTimeImmutable collection function
     * @param string|null $dateTimeCollectionFunction
     * @return NextrasQueryBuilderItem
     */
    public function setDateTimeCollectionFunction(?string $dateTimeCollectionFunction): NextrasQueryBuilderItem
    {
        $this->dateTimeCollectionFunction = $dateTimeCollectionFunction;
        return $this;
    }

    /**
     * @return NextrasQueryBuilder
     */
    public function getQueryBuilder(): NextrasQueryBuilder
    {
        return $this->nextrasQueryBuilder;
    }

}