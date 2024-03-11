<?php

use App\Http\Controllers\backend\CapacityTypeController;
use App\Http\Controllers\backend\DashboardController;
use App\Models\backend\CapacityType;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    }
);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->prefix('backend')->group(
    function () {

        // Defining Controllers Once
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('backend-dashboard');
        });

        // CapacityType CRUD
        Route::controller(CapacityTypeController::class)->group(function () {
            Route::get('/capacity-type/{id?}', 'index')->name('capacity-type-index');
            Route::post('/capacity-type', 'store')->name('capacity-type-store');
            Route::put('/capacity-type-update/{capacityType}', 'update')->name('capacity-type-update');
            Route::delete('/capacity-type-delete', 'delete')->name('capacity-type-delete');
        });
    }
);

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
