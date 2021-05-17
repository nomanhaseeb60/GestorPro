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
//Ruta para CRUD de los  empleados
Route::resource("/empleados", App\Http\Controllers\EmpleadosController::class);
//Ruta para proyectos
Route::resource("/proyectos", App\Http\Controllers\ProyectosController::class);
//Ruta para sprints que hay en cada proyecto
Route::get('/sprint/{proyecto}',[\App\Http\Controllers\SprintsController::class,'index'])->name('sprint.proyectos');
Route::get("sprint/{id}/create", [\App\Http\Controllers\SprintsController::class,'create'])->name('sprint.create');
Route::post("sprint", [\App\Http\Controllers\SprintsController::class,'store'])->name('sprint.store');
Route::put("sprint/{sprint}", [\App\Http\Controllers\SprintsController::class,'update'])->name('sprint.update');
Route::get("sprint/{sprint}/edit", [\App\Http\Controllers\SprintsController::class,'edit'])->name('sprint.edit');
Route::delete("sprint/{sprint}", [\App\Http\Controllers\SprintsController::class,'destroy'])->name('sprint.destroy');
//Ruta para tareas
Route::get('/tareas/{sprint}',[\App\Http\Controllers\TareasController::class,'index'])->name('tareas.sprint');
Route::get("tareas/{id}/create", [\App\Http\Controllers\TareasController::class,'create'])->name('tareas.create');
Route::get('/docs/{proyecto}',[\App\Http\Controllers\ProyectosController::class,'obtenerDocs'])->name('docs.proyecto');



