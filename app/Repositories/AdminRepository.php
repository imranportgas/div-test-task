<?php

namespace App\Repositories;

use App\Models\Application;
use App\Repositories\Common\BaseRepository;

class AdminRepository extends BaseRepository
{
    protected string $modelClassName = Application::class;
}
