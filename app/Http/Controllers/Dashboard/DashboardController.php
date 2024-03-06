<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseDashboardController;
use App\Http\Controllers\BreadCrumb;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseDashboardController
{
    function index(Request $request)
    {
        try {
            $driver =  Driver::count();
            $vehicle =  Vehicle::count();

            $approvedBookings = Booking::where('approval_status', 'approved')
                ->selectRaw('count(*) as count, vehicle_id')
                ->groupBy('vehicle_id')
                ->get()->count();
            $rejectedBookings =  Booking::where('approval_status', 'rejected')
                ->selectRaw('count(*) as count, vehicle_id')
                ->groupBy('vehicle_id')
                ->get()->count();
            $pendingBookings =  Booking::where('approval_status', 'pending')
                ->selectRaw('count(*) as count, vehicle_id')
                ->groupBy('vehicle_id')
                ->get()->count();

            // Grafik 6 bulan terakhir
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            $approvedBooking6bln = Booking::where('approval_status', 'approved')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->get();
            $bookingData = [];
            foreach ($approvedBooking6bln as $booking) {
                $formattedDate = Carbon::parse($booking->created_at)->format('M y');
                if (!isset($bookingData[$booking->vehicle_id][$formattedDate])) {
                    $bookingData[$booking->vehicle_id][$formattedDate] = 1;
                } else {
                    $bookingData[$booking->vehicle_id][$formattedDate]++;
                }
            }
            $series = [];
            $categories = [];
            foreach ($bookingData as $vehicleId => $vehicleData) {
                $vehicleName = Vehicle::find($vehicleId)->registration_number;
                $series[] = [
                    'name' => $vehicleName,
                    'data' => array_values($vehicleData)
                ];
                $categories = array_keys($vehicleData);
            }

            // urutkan categories berdasarkan bulan terlama -> terbaru
            usort($categories, function ($a, $b) {
                return Carbon::parse($a)->timestamp - Carbon::parse($b)->timestamp;
            });

            $this->setTitle('Dashboard');
            $this->setLayout(Session::get('layout', 'layouts.dashboard.vertical'));
            return $this->renderView('dashboard.index', ['driver' => $driver, 'vehicle' => $vehicle, 'approvedBookings' => $approvedBookings, 'rejectedBookings' => $rejectedBookings, 'pendingBookings' => $pendingBookings, 'series' => $series,
            'categories' => $categories]);
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
