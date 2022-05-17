<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all(): Collection;

    public function findOneById(int $id): ?Model;

    public function findOneBy(array $column): ?Model;
}