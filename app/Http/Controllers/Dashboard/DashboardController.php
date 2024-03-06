<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\BreadCrumb;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseDashboardController
{
    function index(Request $request)
    {
        try {
            $this->setTitle('Dashboard');
            $this->setLayout(Session::get('layout', 'layouts.dashboard.vertical'));
            return $this->renderView('dashboard.index');
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            abort(Response::HTTP_INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}
