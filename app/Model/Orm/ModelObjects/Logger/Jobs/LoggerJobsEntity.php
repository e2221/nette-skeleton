<?php


namespace App\Model\Logger\Jobs;

use App\Model\Logger\LoggerEntity;

/**
 * Class LoggerJobsEntity
 * @property int            $id     {primary}
 * @property string         $name
 * @property string|null    $description
 * @property LoggerEntity   $logger {1:m LoggerEntity::$jobId}
 */
class LoggerJobsEntity extends \Nextras\Orm\Entity\Entity
{

}