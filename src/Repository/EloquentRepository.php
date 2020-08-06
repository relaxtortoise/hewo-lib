<?php


namespace Hewo\Lib\Repository;


use Hewo\Lib\Contract\EntityInterface;
use Hewo\Lib\Contract\QueryStrategyInterface;
use Hewo\Lib\Contract\RepositoryInterface;
use Hewo\Lib\Exception\RuntimeException;
use Hewo\Lib\QueryStrategy\DefaultQueryStrategy;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\ModelNotFoundException;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    public const PageName = "page";

    /**
     * @Inject
     * @var ContainerInterface
     */
    public $container;

    /**
     * 搜索策略
     *
     * @var string
     */
    public $searchStrategy = DefaultQueryStrategy::class;

    /**
     * 实体类
     *
     * @return Model|EntityInterface
     */
    abstract public function entity(): EntityInterface;

    /**
     * 从容器中获取搜索策略
     *
     * @return QueryStrategyInterface
     * @throws RuntimeException
     */
    public function searchStrategy() : QueryStrategyInterface
    {
        if (
            !class_exists($this->searchStrategy)
            || !$this->container->has($this->searchStrategy)
        ) {
            throw new RuntimeException("搜索策略类【{$this->searchStrategy}】不存在");
        }
        $searchStrategy = $this->container->get($this->searchStrategy);
        if (!($searchStrategy instanceof QueryStrategyInterface) ) {
            throw new RuntimeException("{$this->searchStrategy} 必须实现 " . QueryStrategyInterface::class . " 接口");
        }
        return $searchStrategy;
    }

    /**
     * 从存储库中获取所有实体
     *
     * @return Collection|EntityInterface[]
     */
    public function all()
    {
        return $this->entity()::all();
    }


    /**
     * 从存储库中获取所有符合条件的实体
     *
     * @param array $input 用于搜索的数据
     * @param int $page 页码数
     * @param int $perPage 页面数据量
     * @return PaginatorInterface
     * @throws RuntimeException
     */
    public function search(array $input, int $page, int $perPage): PaginatorInterface
    {
        return $this->searchStrategy()->process($this->entity()::query(), $input)
            ->paginate($perPage, $this->entity()->attributes(), $this::PageName, $page);
    }

    /**
     * 从存储库中依据主键查找实体
     *
     * @param mixed $id 实体主键
     * @return EntityInterface
     * @throws ModelNotFoundException
     */
    public function findByKey($id): EntityInterface
    {
        /**
         * @var EntityInterface $entity
         */
        $entity = $this->entity()::query()->findOrFail($id);
        return $entity;
    }

    /**
     * 在存储库中更新实体
     *
     * @param EntityInterface $entity
     * @param array $attributes
     * @return bool
     */
    public function updateByEntity(EntityInterface $entity, array $attributes): bool
    {
        return $this->entity()::query()->whereKey($entity->getKey())->update($attributes);
    }

    /**
     * 依据策略销毁实体数据
     *
     * @param EntityInterface $entity
     * @return bool
     */
    public function delete(EntityInterface $entity): bool
    {
        return $this->entity()::query()->whereKey($entity->getKey())->delete();
    }

    /**
     * 存储实体至存储库
     *
     * @param array $attributes
     * @return EntityInterface
     */
    public function create(array $attributes): EntityInterface
    {
        /**
         * @var EntityInterface $entity
         */
        $entity = $this->entity()::query()->create($attributes);
        return $entity;
    }
}