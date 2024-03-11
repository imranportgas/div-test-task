<?php

namespace App\Services;

use App\Models\Application;
use App\Repositories\AdminRepository;

class AdminService
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAllApplications()
    {
        return Application::all();
    }

    public function getFilterApplicationInStatus($status = null, $orderBy = 'created_at', $orderDirection = 'desc')
    {
        $query = Application::query()->where('status', $status);
        $query->orderBy($orderBy, $orderDirection);
        $applications = $query->get();

        return $applications;
    }

}
