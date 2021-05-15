<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

//Ruta CRUD para los clientes
Route::resource("clientes", App\Http\Controllers\ClientesController::class);
//Ruta CRUD para los departamentos
Route::resource("departamentos", App\Http\Controllers\DepartamentosController::class);
//Ruta para CRUD de las categorias
Route::resource("categorias", App\Http\Controllers\CategoriasController::class);
//Ruta para empleados
Route::resource("/empleados", App\Http\Controllers\EmpleadosController::class);


