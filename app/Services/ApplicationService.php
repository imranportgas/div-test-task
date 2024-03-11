<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;

class ApplicationService
{

    protected ApplicationRepository $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        return $this->applicationRepository = $applicationRepository;
    }

    public function validateApplication()
    {

    }
}
