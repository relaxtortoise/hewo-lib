<?php


namespace Hewo\Lib\Model;


use Hewo\Lib\Contract\EntityInterface;
use Hyperf\Database\Model\Model;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

abstract class EloquentEntity extends Model implements EntityInterface, CacheableInterface
{
    use Cacheable;

    public function attributes(): array
    {
        return ["*"];
    }
}