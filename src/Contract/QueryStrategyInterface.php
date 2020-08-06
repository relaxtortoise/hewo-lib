<?php


namespace Hewo\Lib\Contract;

use Hyperf\Database\Model\Builder;

/**
 * 搜索策略接口
 *
 * @package App\Lib\Contract
 */
interface QueryStrategyInterface
{
    /**
     * 搜索策略类执行
     *
     * @param Builder $builder
     * @param array $inputData
     * @return Builder
     */
    public function process(Builder $builder, array $inputData = []): Builder;
}