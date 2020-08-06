<?php


namespace Hewo\Lib\QueryStrategy;


use Hewo\Lib\Contract\QueryStrategyInterface;
use Hyperf\Database\Model\Builder;

class DefaultQueryStrategy implements QueryStrategyInterface
{
    /**
     * 搜索策略类执行
     *
     * @param Builder $builder
     * @param array $inputData
     * @return Builder
     */
    public function process(Builder $builder, array $inputData = []): Builder
    {
        return $builder;
    }
}