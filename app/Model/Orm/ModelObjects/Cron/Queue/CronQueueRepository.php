<?php


namespace App\Model\Cron\Queue;


class CronQueueRepository extends \Nextras\Orm\Repository\Repository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [CronQueueEntity::class];
    }
}