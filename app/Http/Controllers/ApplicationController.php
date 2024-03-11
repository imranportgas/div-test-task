<?php

namespace App\Http\Controllers;

use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected ApplicationService $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function create(Request $request)
    {
        $result = $this->applicationService->createApplication($request->all());
        return response()->json(['data' => $result], 200);
    }

    public function update(Request $request, $id)
    {
        $result = $this->applicationService->respondToApplication($id, $request->all());
        return response()->json(['data' => $result], 200);
    }
}
