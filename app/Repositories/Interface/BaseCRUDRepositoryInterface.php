<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseCRUDRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Model;
}
