<?php declare(strict_types=1);


namespace app\Model\Orm\ModelObjects\Globals;


use App\Model\BaseEntity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Class GlobalsKeysEntity
 * @package app\Model\Orm\ModelObjects\Globals
 *
 * @property int                            $id             {primary}
 * @property string                         $globalKey
 * @property GlobalsEntity[]|OneHasMany     $values         {1:m GlobalsEntity::$globKey}
 */
class GlobalsKeysEntity extends BaseEntity
{
}