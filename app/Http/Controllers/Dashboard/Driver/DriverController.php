<?php

namespace App\Http\Controllers\Dashboard\Driver;

use App\DataTables\DriverDataTable;
use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\BreadCrumb;
use App\Http\Requests\Dashboard\Driver\StoreDriverRequest;
use App\Http\Requests\Dashboard\Driver\UpdateDriverRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DriverController extends BaseDashboardController
{
    function index(DriverDataTable $dataTable, Request $request)
    {
        $this->addBreadcrumb(new BreadCrumb(route('dashboard'), 'Data Master'));
        $this->addBreadcrumb(new BreadCrumb(route('dashboard.driver.drivers.index'), 'Driver'));
        $this->addData('head', 'Driver');
        $this->setTitle('Driver');
        $this->setLayout(Session::get('layout', 'layouts.dashboard.vertical'));
        return $this->renderDatatable($dataTable, 'dashboard.driver.drivers.index');
    }

    function store(StoreDriverRequest $request) {
        $data = $request->validated();

        try {
            $item = Driver::create($data);
    
            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Driver berhasil ditambahkan', $item);
            }
    
            return redirect()->route('dashboard.driver.drivers.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }

    function update(UpdateDriverRequest $request, Driver $driver)
    {
        $data = $request->validated();

        try {
            $driver->update($data);

            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Driver berhasil diubah', $driver);
            }

            return redirect()->route('dashboard.driver.drivers.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }

    function destroy(Request $request, Driver $driver)
    {
        try {
            $driver->delete();

            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Driver berhasil dihapus', $driver);
            }

            return redirect()->route('dashboard.driver.drivers.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }
}
