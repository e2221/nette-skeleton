<?php


namespace App\Model\Cron\Log;


class CronLogRepository extends \Nextras\Orm\Repository\Repository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [CronLogEntity::class];
    }
}