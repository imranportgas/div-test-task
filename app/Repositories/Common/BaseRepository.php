<?php

namespace App\Repositories\Common;

use App\Repositories\Interface\BaseCRUDRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseCRUDRepositoryInterface
{
    protected Model $model;
    public function getAll(): Collection
    {
        return $this->model::query()->get();
    }

    public function getById(int $id): ?Model
    {
        return $this->model::query()->find($id);
    }
}
