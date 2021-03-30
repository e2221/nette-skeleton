<?php


namespace App\Model\Logger;

use App\Model\Logger\Jobs\LoggerJobsEntity;
use DateTimeImmutable;

/**
 * Class LoggerEntity
 * @property int                    $id             {primary}
 * @property DateTimeImmutable      $datetime       {default now}
 * @property LoggerJobsEntity|null  $jobId          {m:1 LoggerJobsEntity::$logger}
 * @property string|null            $callStack      {default null}
 * @property bool                   $result         {default true}
 * @property string|null            $resultMessage  {default null}
 */
class LoggerEntity extends \Nextras\Orm\Entity\Entity
{

}