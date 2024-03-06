<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


require __DIR__ . '/web/dashboard.php';
require __DIR__ . '/web/workspace.php';
require __DIR__ . '/web/auth.php';
require __DIR__ . '/web/landing.php';
