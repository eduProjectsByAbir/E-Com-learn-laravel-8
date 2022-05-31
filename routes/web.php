<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view( 'welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
    // Route::post('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
});

Route::middleware(['is_admin', 'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
});


Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
