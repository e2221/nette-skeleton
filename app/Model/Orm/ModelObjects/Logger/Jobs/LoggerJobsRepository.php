<?php


namespace App\Model\Logger\Jobs;


class LoggerJobsRepository extends \Nextras\Orm\Repository\Repository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [LoggerJobsEntity::class];
    }
}