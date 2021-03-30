<?php

namespace App\orm;

use Nextras\Dbal\QueryBuilder\QueryBuilder;
use Nextras\Orm\Collection\Functions\IQueryBuilderFunction;
use Nextras\Orm\Collection\Helpers\DbalExpressionResult;
use Nextras\Orm\Collection\Helpers\DbalQueryBuilderHelper;

class FullLikeFilterFunction implements IQueryBuilderFunction
{
    public function processQueryBuilderExpression(DbalQueryBuilderHelper $helper, QueryBuilder $builder, array $args): DbalExpressionResult
    {
        // check if we received enough arguments
        assert(count($args) === 2 && is_string($args[0]) && is_string($args[1]));

        $expression = $helper->processPropertyExpr($builder, $args[0]);
        return $expression->append('LIKE %_like_', $args[1]);
    }
}


