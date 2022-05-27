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
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\Admin\CategoriesController;

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

Route::get('/', [WelcomeController::class, "index"]);
Route::post('/contact', [ContactController::class, 'save']);

Auth::routes();



Route::group(['middleware' => ['auth', 'validarRol', 'validarEstado']], function () {

    //<------------Roles------------>

    Route::get('/roles/updateState/{id}/{state}', [RolesController::class, "updateState"]);
    Route::get('/roles/notActive', [RolesController::class, "notActive"]);

    //<------------Users------------>

    Route::get('/users/updateState/{id}/{state}', [UsersController::class, "updateState"]);
    Route::get('/users/notActive', [UsersController::class, "notActive"]);

    //<------------Plates----------->

    Route::get('/plates/notActive', [PlatesController::class, 'notActive']);
    Route::get('/plates/updateState/{id}', [PlatesController::class, 'updateState']);
    //<----------Categories--------->

    Route::get('/categories/notActive', [CategoriesController::class, 'notActive']);
    Route::get('/categories/updateState/{id}', [CategoriesController::class, 'updateState']);


    //<-----------Contact----------->

    Route::get('/contact/lastMessages', [ContactController::class, 'lastMessages']);
    Route::get('/contact/{id}', [ContactController::class, 'show']);
    Route::get('/contact', [ContactController::class, 'index']);

    //<----------Resources---------->

    Route::resource('users', UsersController::class)->only(['index', 'create', 'store', 'show', 'update']);
    Route::resources([
        'roles' => RolesController::class,
        'plates' => PlatesController::class,
        'categories' => CategoriesController::class,
    ]);
});


Route::group(['middleware' => ['auth', 'validarEstado']], function () {

    //<-----------Home------------>
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //<-----------Users------------>

    Route::resource('users', UsersController::class)->only(['edit']);
    Route::get('/users/profile/{id}', [UsersController::class, 'profile']);
    Route::get('/users/EditPassword/{id}', [UsersController::class, 'EditPassword']);
    Route::post('/users/UpdatePassword/{id}', [UsersController::class, 'UpdatePassword']);
    Route::post('/users/update/{id}', [UsersController::class, 'updateEmployee']);


    //<---------Bookings----------->

    Route::get('/bookings/updateState/{id}/{state}', [BookingsController::class, "updateState"]);
    Route::get('/bookings/seeCanceled', [BookingsController::class, "seeCanceled"]);
    Route::get('/bookings/seeApproved', [BookingsController::class, "seeApproved"]);
    Route::get('/bookings/getBookingsCount', [BookingsController::class, 'getBookingsCount']);

    //<---------Customers----------->

    Route::get('/customers/notActive', [CustomersController::class, 'notActive']);
    Route::get('/customers/updateState/{id}', [CustomersController::class, 'updateState']);

    //<-----------Event------------>

    Route::get('/events/old', [EventsController::class, 'oldEvents']);
    Route::get('/events/updateState/{id}', [EventsController::class, 'updateState']);



    //<-----------Sales------------>
    Route::get('/sales/canceledSales', [SalesController::class, 'canceledSales']);
    Route::get('/sales/updateState/{id}', [SalesController::class, 'updateState']);
    Route::get('/plates/getPricePlate/{id}', [PlatesController::class, 'getPricePlate']);
    Route::get('/sales/getSalesCount', [SalesController::class, 'getSalesCount']);

    //<----------Resources---------->

    Route::resources([
        'customers' => CustomersController::class,
        'events' => EventsController::class,
        'bookings' => BookingsController::class,
        'sales' => SalesController::class,
    ]);
});
