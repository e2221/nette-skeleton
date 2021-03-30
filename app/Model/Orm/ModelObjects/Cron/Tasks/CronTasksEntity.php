<?php


namespace App\Model\Cron\Tasks;

/**
 * Class CronTasksEntity
 * @property int                $id             {primary}
 * @property string             $serviceName
 * @property string             $methodName
 * @property string             $description    {default null}
 */
class CronTasksEntity extends \Nextras\Orm\Entity\Entity
{

}