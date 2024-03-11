<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAll(Request $request)
    {
        $result = $this->adminService->getAllApplications($request->all());
        return response()->json(['Applications' => $result]);
    }
    public function sortApplications(Request $request)
    {
        $result = $this->adminService->getFilterApplicationInStatus($request->all());
        return response()->json(['Applications' => $result]);
    }
}
