<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\EventsController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'validarRol']], function () {
    Route::resources([
        'roles' => RolesController::class,
        'users' => UsersController::class,
    ]);
    Route::get('/roles/listar/{condicion}', [RolesController::class, "listar"]);
    Route::get('/roles/cambiarEstado/{id}/{estado}', [RolesController::class, "cambiarEstado"]);
    Route::get('/roles/verDetalles/{id}', [RolesController::class, "verDetalles"]);
    Route::get('/roles/verDeshabilitados', [RolesController::class, "verDeshabilitados"]);


    Route::get('/usuarios/listar/{condicion}', [UsersController::class, "listar"]);
    Route::get('/usuarios/cambiarEstado/{id}/{estado}', [UsersController::class, "cambiarEstado"]);
    Route::get('/usuarios/verDetalles/{id}', [UsersController::class, "verDetalles"]);
    Route::get('/usuarios/verDeshabilitados', [UsersController::class, "verDeshabilitados"]);
});


Route::group(['middleware' => 'auth'], function () {

    Route::get('/reservas/listar/{condicion}', [BookingsController::class, "listar"]);
    Route::get('/reservas/cambiarEstado/cancelar/{id}/{estado}', [BookingsController::class, "cambiarEstado"]);
    Route::get('/reservas/cambiarEstado/enProceso/{id}/{estado}', [BookingsController::class, "cambiarEstado"]);
    Route::get('/reservas/cambiarEstado/aprobar/{id}/{estado}', [BookingsController::class, "cambiarEstado"]);
    Route::get('/reservas/verDetalles/{id}', [BookingsController::class, "verDetalles"]);
    Route::get('/reservas/verCanceladas', [BookingsController::class, "verCanceladas"]);
    Route::get('/reservas/verAprobadas', [BookingsController::class, "verAprobadas"]);

    //<---------Customers----------->

    Route::get('/customers/notActive', [CustomersController::class, 'notActive']);
    Route::get('/customers/updateState/{id}', [CustomersController::class, 'updateState']);

    //<-----------Events------------>



    Route::resources([
        'menu' => MenuController::class,
        'customers' => CustomersController::class,
        'events' => EventsController::class,
        'bookings' => BookingsController::class,
    ]);

    //customer



});

