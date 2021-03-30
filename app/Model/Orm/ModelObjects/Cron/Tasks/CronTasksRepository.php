<?php


namespace App\Model\Cron\Tasks;


class CronTasksRepository extends \Nextras\Orm\Repository\Repository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [CronTasksEntity::class];
    }
}