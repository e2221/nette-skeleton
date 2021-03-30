<?php
declare(strict_types=1);

namespace App\Model;

use App\orm\FullLikeFilterFunction;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\IRepository;

class NextrasQueryBuilder
{
    /** @var NextrasQueryBuilderItem[] */
    protected array $items = [];

    /** @var IRepository  */
    protected IRepository $repository;

    /** @var ICollection|null  */
    protected ?ICollection $startupCollection=null;

    /** @var string|null Collection function for strings */
    public ?string $defaultStringCollectionFunction = null;

    /** @var string|null Collection function for integers */
    public ?string $defaultOIntegersCollectionFunction = null;

    /** @var string|null Collection function for DateTimeImmutable */
    public ?string $defaultDateTimeCollectionFunction = null;

    /**
     * NextrasQueryBuilder constructor.
     * @param IRepository $repository
     */
    public function __construct(IRepository $repository)
    {
        $this->defaultStringCollectionFunction = FullLikeFilterFunction::class;
        $this->repository = $repository;
        return $this;
    }

    /**
     * Add item to builder
     * @param $parameters
     * @param string $operatorInternal
     * @return NextrasQueryBuilderItem
     */
    public function addItem($parameters, string $operatorInternal=ICollection::AND): NextrasQueryBuilderItem
    {
        $item = $this->items[] = new NextrasQueryBuilderItem($this, $this->repository, $parameters, $operatorInternal);
        $item->setStringCollectionFunction($this->defaultStringCollectionFunction);
        $item->setIntegersCollectionFunction($this->defaultOIntegersCollectionFunction);
        $item->setDateTimeCollectionFunction($this->defaultDateTimeCollectionFunction);
        return $item;
    }

    /**
     * Build query
     * @return ICollection|IRepository
     */
    public function build()
    {
        $builder = $this->startupCollection ?? $this->repository;
        $i = 0;
        foreach($this->items as $itemKey => $item)
        {
            $findSet = $item->getFindSet();
            if(is_null($findSet))
                continue;
            $builder = $builder->findBy($findSet);
            $i++;
        }
        if($i > 0)
            return $builder;


        if($builder instanceof IRepository)
        {
            return $builder->findAll();
        }else{
            return $builder;
        }
    }

    /**
     * Set startup collection
     * @param ICollection|null $startupCollection
     */
    public function setStartupCollection(?ICollection $startupCollection): void
    {
        $this->startupCollection = $startupCollection;
    }

    /**
     * @param string|null $defaultStringCollectionFunction
     * @return NextrasQueryBuilder
     */
    public function setDefaultStringCollectionFunction(?string $defaultStringCollectionFunction): NextrasQueryBuilder
    {
        $this->defaultStringCollectionFunction = $defaultStringCollectionFunction;
        return $this;
    }

    /**
     * @param string|null $defaultOIntegersCollectionFunction
     * @return NextrasQueryBuilder
     */
    public function setDefaultOIntegersCollectionFunction(?string $defaultOIntegersCollectionFunction): NextrasQueryBuilder
    {
        $this->defaultOIntegersCollectionFunction = $defaultOIntegersCollectionFunction;
        return $this;
    }

    /**
     * @param string|null $defaultDateTimeCollectionFunction
     * @return NextrasQueryBuilder
     */
    public function setDefaultDateTimeCollectionFunction(?string $defaultDateTimeCollectionFunction): NextrasQueryBuilder
    {
        $this->defaultDateTimeCollectionFunction = $defaultDateTimeCollectionFunction;
        return $this;
    }

    /**
     * @return NextrasQueryBuilderItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}