<?php declare(strict_types=1);


namespace app\Model\Orm\ModelObjects\Globals;


class GlobalsRepository extends \App\Model\BaseRepository
{

    /**
     * @inheritDoc
     */
    public static function getEntityClassNames(): array
    {
        return [GlobalsEntity::class];
    }
}