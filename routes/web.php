<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\MenuController;

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
    Route::get('/roles', [RolesController::class, "index"]);
    Route::get('/roles/listar/{condicion}', [RolesController::class, "listar"]);
    Route::get('/roles/crear', [RolesController::class, "crear"]);
    Route::post('/roles/guardar', [RolesController::class, "guardar"]);
    Route::get('/roles/editar/{id}', [RolesController::class, "editar"]);
    Route::post('/roles/actualizar/{id}', [RolesController::class, "actualizar"]);
    Route::get('/roles/cambiarEstado/{id}/{estado}', [RolesController::class, "cambiarEstado"]);
    Route::get('/roles/verDetalles/{id}', [RolesController::class, "verDetalles"]);
    Route::get('/roles/verDeshabilitados', [RolesController::class, "verDeshabilitados"]);

    Route::get('/usuarios', [UsuariosController::class, "index"]);
    Route::get('/usuarios/listar/{condicion}', [UsuariosController::class, "listar"]);
    Route::get('/usuarios/crear', [UsuariosController::class, 'crear']);
    Route::post('/usuarios/insertar', [UsuariosController::class, 'insertar']);
    Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'editar']);
    Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'actualizar']);
    Route::get('/usuarios/cambiarEstado/{id}/{estado}', [UsuariosController::class, "cambiarEstado"]);
    Route::get('/usuarios/verDetalles/{id}', [UsuariosController::class, "verDetalles"]);
    Route::get('/usuarios/verDeshabilitados', [UsuariosController::class, "verDeshabilitados"]);
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/reservas', [ReservasController::class, "index"]);
    Route::get('/reservas/listar/{condicion}', [ReservasController::class, "listar"]);
    Route::get('/reservas/crear', [ReservasController::class, 'crear']);
    Route::post('/reservas/insertar', [ReservasController::class, 'insertar']);
    Route::get('/reservas/editar/{id}', [ReservasController::class, 'editar']);
    Route::post('/reservas/actualizar/{id}', [ReservasController::class, 'actualizar']);
    Route::get('/reservas/cambiarEstado/cancelar/{id}/{estado}', [ReservasController::class, "cambiarEstado"]);
    Route::get('/reservas/cambiarEstado/enProceso/{id}/{estado}', [ReservasController::class, "cambiarEstado"]);
    Route::get('/reservas/cambiarEstado/aprobar/{id}/{estado}', [ReservasController::class, "cambiarEstado"]);
    Route::get('/reservas/verDetalles/{id}', [ReservasController::class, "verDetalles"]);
    Route::get('/reservas/verCanceladas', [ReservasController::class, "verCanceladas"]);
    Route::get('/reservas/verAprobadas', [ReservasController::class, "verAprobadas"]);
    Route::resources([
        'menu' => MenuController::class
    ]);
});
