<?php

namespace App\Http\Controllers\Dashboard\Logs;

use App\DataTables\ActivityDataTable;
use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\BreadCrumb;
use Illuminate\Support\Facades\Session;

class ActivityController extends BaseDashboardController
{
    function index(ActivityDataTable $dataTable)
    {
        $this->addBreadcrumb(new BreadCrumb(route('dashboard'), 'Logs'));
        $this->addBreadcrumb(new BreadCrumb(route('dashboard.logs.activity.index'), 'Activities'));
        $this->addData('head', 'Aktivitas');
        $this->setLayout(Session::get('layout', 'layouts.dashboard.vertical'));
        return $this->renderDatatable($dataTable, 'dashboard.logs.activity.index');
    }
}
