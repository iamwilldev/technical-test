<?php

namespace App\Http\Controllers\Dashboard\Vehicle;

use App\DataTables\VehicleDataTable;
use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\BreadCrumb;
use App\Http\Requests\Dashboard\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Dashboard\Vehicle\UpdateVehicleRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class VehicleController extends BaseDashboardController
{
    function index(VehicleDataTable $dataTable, Request $request)
    {
        $this->addBreadcrumb(new BreadCrumb(route('dashboard'), 'Data Master'));
        $this->addBreadcrumb(new BreadCrumb(route('dashboard.vehicle.vehicles.index'), 'Kendaraan'));
        $this->addData('head', 'Kendaraan');
        $this->setTitle('Kendaraan');
        $this->setLayout(Session::get('layout', 'layouts.dashboard.vertical'));
        return $this->renderDatatable($dataTable, 'dashboard.vehicle.vehicles.index');
    }

    function store(StoreVehicleRequest $request) {
        $data = $request->validated();

        try {
            $item = Vehicle::create($data);
    
            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Kendaraan berhasil ditambahkan', $item);
            }
    
            return redirect()->route('dashboard.vehicle.vehicles.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }

    function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $data = $request->validated();

        try {
            $vehicle->update($data);

            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Kendaraan berhasil diubah', $vehicle);
            }

            return redirect()->route('dashboard.vehicle.vehicles.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }

    function destroy(Request $request, Vehicle $vehicle)
    {
        try {
            $vehicle->delete();

            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Kendaraan berhasil dihapus', []);
            }

            return redirect()->route('dashboard.vehicle.vehicles.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }
}
