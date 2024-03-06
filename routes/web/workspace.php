<?php

use Illuminate\Support\Facades\Route;

Route::prefix('workspace')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
});
