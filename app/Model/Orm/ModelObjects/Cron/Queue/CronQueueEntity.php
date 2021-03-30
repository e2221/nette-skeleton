<?php


namespace App\Model\Cron\Queue;

use App\Model\Cron\Tasks\CronTasksEntity;
use DateTimeImmutable;

/**
 * Class CronQueueEntity
 * @property int                        $id                 {primary}
 * @property CronTasksEntity            $taskId             {m:1 CronTasksEntity, oneSided=true}
 * @property DateTimeImmutable          $creation           {default now}
 * @property bool                       $active             {default false}
 * @property DateTimeImmutable|null     $activationDate     {default null}
 */
class CronQueueEntity extends \Nextras\Orm\Entity\Entity
{
    public function setAaActive(): void
    {
        $this->active = true;
        $this->activationDate = new DateTimeImmutable();
    }
}