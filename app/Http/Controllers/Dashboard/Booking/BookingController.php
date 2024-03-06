<?php

namespace App\Http\Controllers\Dashboard\Booking;

use App\DataTables\BookingDataTable;
use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\BreadCrumb;
use App\Http\Requests\Dashboard\Booking\StoreBookingRequest;
use App\Http\Requests\Dashboard\Booking\UpdateBookingRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class BookingController extends BaseDashboardController
{
    function index(BookingDataTable $dataTable, Request $request)
    {
        $this->addBreadcrumb(new BreadCrumb(route('dashboard.booking.bookings.index'), 'Pemesanan Kendaraan'));
        $this->addData('head', 'Pemesanan Kendaraan');
        $this->setTitle('Pemesanan Kendaraan');
        $this->setLayout(Session::get('layout', 'layouts.dashboard.vertical'));
        return $this->renderDatatable($dataTable, 'dashboard.booking.bookings.index');
    }

    function store(StoreBookingRequest $request) 
    {
        $data = $request->validated();

        foreach ($data['approvals'] as $key => $value) {
            $data['approvals'][$key]['status'] = 'pending';
        }

        $data['approvals'] = json_encode($data['approvals']);

        // dd($data);

        try {
            $item = Booking::create($data);
    
            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Pemesanan Kendaraan berhasil ditambahkan', $item);
            }
    
            return redirect()->route('dashboard.booking.bookings.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }

    function update(Booking $booking, UpdateBookingRequest $request) {
        $data = $request->validated();

        $statusApprovals = [];
        foreach ($data['approvals'] as $key => $value) {
            $data['approvals'][$key]['status'] = $data['approvals'][$key]['status'] ?? 'pending';
            if ($value['status'] == 'rejected') {
                $statusApprovals[] = 'rejected';
            } else if ($value['status'] == 'approved') {
                $statusApprovals[] = 'approved';
            } else {
                $statusApprovals[] = 'pending';
            }
        }

        if (in_array('rejected', $statusApprovals)) {
            $data['approval_status'] = 'rejected';
        } else if (in_array('pending', $statusApprovals)) {
            $data['approval_status'] = 'pending';
        } else {
            $data['approval_status'] = 'approved';
        }

        // dd($data);

        try {
            $booking->update($data);

            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Pemesanan Kendaraan berhasil diubah', $booking);
            }

            return redirect()->route('dashboard.booking.bookings.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }

    function destroy(Request $request, Booking $booking)
    {
        try {
            $booking->delete();

            if ($request->expectsJson()) {
                return new DefaultResource(true, 'Pemesanan Kendaraan berhasil dihapus', $booking);
            }

            return redirect()->route('dashboard.booking.bookings.index');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return new DefaultResource(false, $e->getMessage(), []);
            }
            abort(500, $e->getMessage());
        }
    }
}
