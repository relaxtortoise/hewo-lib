<?php


namespace Hewo\Lib\Contract;


use Hyperf\Contract\PaginatorInterface;
use Hyperf\Database\Model\ModelNotFoundException;

/**
 * 存储库接口
 *
 * @package App\Lib\Contract
 */
interface RepositoryInterface
{
    /**
     * 从存储库中获取所有实体
     *
     * @return EntityInterface[]
     */
    public function all();

    /**
     * 从存储库中获取所有符合条件的实体
     *
     * @param array $input 用于搜索的数据
     * @param int $page 页码数
     * @param int $perPage 页面数据量
     * @return PaginatorInterface
     */
    public function search(array $input, int $page, int $perPage) : PaginatorInterface;

    /**
     * 从存储库中依据主键查找实体
     *
     * @param mixed $id 实体主键
     * @return EntityInterface
     * @throws ModelNotFoundException
     */
    public function findByKey($id) : EntityInterface;

    /**
     * 在存储库中更新实体
     *
     * @param EntityInterface $entity
     * @param array $attributes
     * @return bool
     */
    public function updateByEntity(EntityInterface $entity, array $attributes): bool;

    /**
     * 销毁实体数据
     *
     * @param EntityInterface $entity
     * @return bool
     */
    public function delete(EntityInterface $entity) : bool;

    /**
     * 存储实体至存储库
     *
     * @param array $attributes
     * @return EntityInterface
     */
    public function create(array $attributes): EntityInterface;
}