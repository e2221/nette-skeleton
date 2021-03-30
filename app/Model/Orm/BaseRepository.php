<?php

namespace App\Model;


use App\orm\FullLikeFilterFunction;
use App\orm\LeftLikeFilterFunction;
use App\orm\RightLikeFilterFunction;
use Nextras\Orm\Collection\Functions\ConjunctionOperatorFunction;
use Nextras\Orm\Collection\Functions\DisjunctionOperatorFunction;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

abstract class BaseRepository extends Repository
{
    /**
     * Create collection function
     * @param string $name
     * @return LeftLikeFilterFunction|ConjunctionOperatorFunction|DisjunctionOperatorFunction
     */
    public function createCollectionFunction(string $name)
    {
        return match ($name) {
            LeftLikeFilterFunction::class => new LeftLikeFilterFunction(),
            RightLikeFilterFunction::class => new RightLikeFilterFunction(),
            FullLikeFilterFunction::class => new FullLikeFilterFunction(),
            default => parent::createCollectionFunction($name),
        };
        /*
        if ($name === LeftLikeFilterFunction::class) {
            return new LeftLikeFilterFunction();
        } elseif ($name )
        } else {
            return parent::createCollectionFunction($name);
        }*/
    }

    /**
     * Get result by column
     * @param ICollection $collection
     * @param string|array $columnName  [string = column name, array = for another table key [$columnName, $key]
     * @param bool $assoc
     * @param string $assocByColumn
     * @return array
     */
    public function getResultByColumn(ICollection $collection, $columnName='id', bool $assoc=false, string $assocByColumn='id'): array
    {
        $result = [];
        foreach ($collection as $index => $item) {
            if($assoc === true){
                $result[$item->$assocByColumn] = $item->$columnName;
            }else{
                $value = null;
                if(is_array($columnName)){
                    foreach($columnName as $part){
                        if(is_null($value)){
                            $value = $item->$part;
                        }else{
                            $value = $value->$part;
                        }
                    }
                    $result[] = $value;
                }else{
                    $result[] = $item->$columnName;
                }
            }
        }
        return $result;
    }

    /**
     * Get Find Builder
     * @param null|ICollection $startupCollection
     * @return NextrasQueryBuilder
     */
    public function getQueryBuilder(?ICollection $startupCollection=null): NextrasQueryBuilder
    {
         $builder = new NextrasQueryBuilder($this);
         $builder->setStartupCollection($startupCollection);
         return $builder;
    }
}