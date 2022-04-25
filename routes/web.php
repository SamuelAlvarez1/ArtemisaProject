<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\Admin\PlatesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CategoriesController;

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
    $plates = \App\Models\Plate::all()->take(3);
    return view('welcome', compact('plates'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('home', [HomeController::class, 'fecha'])->name('fecha');


Route::group(['middleware' => ['auth', 'validarRol']], function () {

    //<------------Roles------------>

    Route::get('/roles/updateState/{id}/{state}', [RolesController::class, "updateState"]);
    Route::get('/roles/notActive', [RolesController::class, "notActive"]);

    //<-----------Users------------>

    Route::get('/users/updateState/{id}/{state}', [UsersController::class, "updateState"]);
    Route::get('/users/notActive', [UsersController::class, "notActive"]);

    //<---------Resources---------->

    Route::resources([
        'roles' => RolesController::class,
        'users' => UsersController::class,
    ]);
});


Route::group(['middleware' => 'auth'], function () {


    Route::get('/users/profile/{id}', [UsersController::class, 'profile']);


    //<---------Bookings----------->

    Route::get('/bookings/updateState/{id}/{state}', [BookingsController::class, "updateState"]);
    Route::get('/bookings/seeCanceled', [BookingsController::class, "seeCanceled"]);
    Route::get('/bookings/seeApproved', [BookingsController::class, "seeApproved"]);

    //<---------Customers----------->

    Route::get('/customers/notActive', [CustomersController::class, 'notActive']);
    Route::get('/customers/updateState/{id}', [CustomersController::class, 'updateState']);

    //<-----------Event------------>

    Route::get('/events/old', [EventsController::class, 'oldEvents']);
    Route::get('/events/updateState/{id}', [EventsController::class, 'updateState']);


    //<-----------Plates------------>

    Route::get('/plates/notActive', [PlatesController::class, 'notActive']);
    Route::get('/plates/updateState/{id}', [PlatesController::class, 'updateState']);
    Route::get('/plates/updateStateVariation/{id}', [PlatesController::class, 'updateStateVariation']);
    Route::get('/plates/getPricePlate/{id}', [PlatesController::class, 'getPricePlate']);

    //<---------Categories----------->

    Route::get('/categories/notActive', [CategoriesController::class, 'notActive']);
    Route::get('/categories/updateState/{id}', [CategoriesController::class, 'updateState']);

    //<-----------Sales------------>
    Route::get('/sales/canceledSales', [SalesController::class, 'canceledSales']);
    Route::get('/sales/updateState/{id}', [SalesController::class, 'updateState']);

    //<----------Resources---------->

    Route::resources([
        'plates' => PlatesController::class,
        'customers' => CustomersController::class,
        'events' => EventsController::class,
        'bookings' => BookingsController::class,
        'sales' => SalesController::class,
        'categories' => CategoriesController::class
    ]);
});
