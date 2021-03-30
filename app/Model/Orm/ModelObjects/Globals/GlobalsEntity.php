<?php declare(strict_types=1);


namespace app\Model\Orm\ModelObjects\Globals;


use App\Model\BaseEntity;

/**
 * Class GlobalsEntity
 * @package app\Model\Orm\ModelObjects\Globals
 *
 * @property int                            $id             {primary}
 * @property string|null                    $intKey         {default null}
 * @property GlobalsKeysEntity|null         $globKey        {m:1 GlobalsKeysEntity::$values}
 * @property string|int|float|null          $value          {default null}
 * @property string|null                    $description    {default null}
 */
class GlobalsEntity extends BaseEntity
{

}