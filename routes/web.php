<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorReportController;
use App\Http\Controllers\SolarPanelController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('root');
});

// Dashboard route that links to the dashboardcontroller controller's index method. Using the auth and verified middleware.

Route::get('dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

// My errors resource route (resource routes generate all the necessary routes for CRUD. This leads to my ErrorReportController controller)

Route::resource('errors', ErrorReportController::class)->middleware(['auth', 'verified']);

// My panelsresource route (resource routes generate all the necessary routes for CRUD. This leads to my SolarPanelController controller)

Route::resource('panels', SolarPanelController::class)->middleware(['auth', 'verified']);

// Companies resource route

Route::resource('companies', CompanyController::class)->middleware(['auth', 'verified']);

// The registerPanel get route will clal the SolarPanelController's registerPanel method. 

Route::get('/registerpanel', [SolarPanelController::class, 'registerPanel'])->middleware(['auth', 'verified'])->name('panels.registerPanel');


// Laravel breeze auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/subscribe', [ProfileController::class, 'subscribe'])->name('profile.subscribe');
});

require __DIR__.'/auth.php';
