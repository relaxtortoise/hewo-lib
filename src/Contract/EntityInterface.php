<?php


namespace Hewo\Lib\Contract;

/**
 * 实体接口
 *
 * @package Hewo\Lib\Contract
 */
interface EntityInterface
{
    /**
     * 实体主键
     * @return mixed
     */
    public function getKey();

    /**
     * 实体更新
     *
     * @param array $attributes
     * @param array $options
     * @return mixed
     */
    public function update(array $attributes = [], array $options = []);

    /**
     * 实体属性
     *
     * @return array
     */
    public function attributes(): array;
}