<?php declare(strict_types=1);


namespace App\Model\Orm;


use App\Model\Cron\Log\CronLogRepository;
use App\Model\Cron\Queue\CronQueueRepository;
use App\Model\Cron\Tasks\CronTasksRepository;
use App\Model\Logger\Jobs\LoggerJobsRepository;
use App\Model\Logger\LoggerRepository;
use App\Model\MainMenu\MainMenuRepository;
use app\Model\Orm\ModelObjects\Globals\GlobalsKeysRepository;
use app\Model\Orm\ModelObjects\Globals\GlobalsRepository;
use App\Model\User\MyNotes\MyNotesRepository;
use App\Model\User\Roles\Define\RoleDefineRepository;
use App\Model\User\Roles\RolesRepository;
use App\Model\User\ToDoList\ToDoListRepository;
use App\Model\User\UserApps\UserAppsRepository;
use App\Model\User\UserRepository;
use App\Model\UsersACL\Repository\AclPrivilegesRepository;
use App\Model\UsersACL\Repository\AclResourcesRepository;
use App\Model\UsersACL\Repository\AclRolesRepository;
use App\Model\UsersACL\Repository\AclRolesResourcesRepository;
use App\Model\UsersACL\Repository\AclUsersRepository;
use App\Model\UsersACL\Repository\AclUsersRolesRepository;
use Nextras\Orm\Model\Model;

/**
 * Class NextrasOrm
 * @package App\Model\Orm
 *
 *
 * ACL
 * @property-read AclPrivilegesRepository   $aclPrivileges
 * @property-read AclUsersRepository        $aclUsers
 * @property-read AclUsersRolesRepository   $aclUsersRoles
 * @property-read AclRolesResourcesRepository $aclRolesResources
 * @property-read AclResourcesRepository    $aclResources
 * @property-read AclRolesRepository        $aclRoles
 *
 *
 * * Logger
 * @property-read LoggerRepository          $logger
 * @property-read LoggerJobsRepository      $loggerJobs
 *
 * Cron
 * @property-read CronTasksRepository       $cronTasks
 * @property-read CronQueueRepository       $cronQueue
 * @property-read CronLogRepository         $cronLog
 *
 * @property-read MainMenuRepository        $mainMenu
 *
 *
 * Globals
 * @property-read GlobalsRepository $globals
 * @property-read GlobalsKeysRepository $globalsKeys
 *
 */
class NextrasOrm extends Model
{

}