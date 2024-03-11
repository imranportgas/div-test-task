<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    protected string $modelClassName = User::class;
}
