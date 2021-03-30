<?php


namespace App\Model\Cron\Log;

use App\Model\Cron\Tasks\CronTasksEntity;
use DateTimeImmutable;

/**
 * Class CronLogEntity
 * @property int                $id             {primary}
 * @property CronTasksEntity    $taskId         {m:1 CronTasksEntity, oneSided=true}
 * @property DateTimeImmutable  $activatedDate
 * @property DateTimeImmutable  $completedDate  {default now}
 */
class CronLogEntity extends \Nextras\Orm\Entity\Entity
{

}