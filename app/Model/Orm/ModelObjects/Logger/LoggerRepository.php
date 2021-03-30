<?php


namespace App\Model\Logger;


use App\Model\Logger\LoggerEntity;

class LoggerRepository extends \Nextras\Orm\Repository\Repository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [LoggerEntity::class];
    }
}