<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function all(): Collection
    {
        return $this
            ->entity
            ->all();
    }

    public function findOneById(int $id): ?Model
    {
        return $this
            ->entity
            ->query()
            ->find($id);
    }

    public function findOneBy(array $column): ?Model
    {
        return $this->entity
            ->query()
            ->where(key($column), reset($column))
            ->first();
    }
}