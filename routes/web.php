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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
/**
 * Las siguientes rutas son para el rol administrador.
 */
Route::group(['middleware' => ['role:administrador']], function () {
    //Ruta CRUD para los clientes
    Route::resource("clientes", App\Http\Controllers\ClientesController::class)->middleware('auth');
    //Ruta CRUD para los departamentos
    Route::resource("departamentos", App\Http\Controllers\DepartamentosController::class)->middleware('auth');
    //Ruta para CRUD de las categorias
    Route::resource("categorias", App\Http\Controllers\CategoriasController::class)->middleware('auth');
    //Ruta para CRUD de los  empleados
    Route::resource("/empleados", App\Http\Controllers\EmpleadosController::class)->middleware('auth');
    //Ruta para proyectos
    Route::resource("/proyectos", App\Http\Controllers\ProyectosController::class)->middleware('auth');
    //Ruta para sprints que hay en cada proyecto
    Route::get('/sprint/{proyecto}',[\App\Http\Controllers\SprintsController::class,'index'])->name('sprint.proyectos')->middleware('auth');
    Route::get("sprint/{id}/create", [\App\Http\Controllers\SprintsController::class,'create'])->name('sprint.create')->middleware('auth');
    Route::post("sprint", [\App\Http\Controllers\SprintsController::class,'store'])->name('sprint.store')->middleware('auth');
    Route::put("sprint/{sprint}", [\App\Http\Controllers\SprintsController::class,'update'])->name('sprint.update')->middleware('auth');
    Route::get("sprint/{sprint}/edit", [\App\Http\Controllers\SprintsController::class,'edit'])->name('sprint.edit')->middleware('auth');
    Route::delete("sprint/{sprint}", [\App\Http\Controllers\SprintsController::class,'destroy'])->name('sprint.destroy')->middleware('auth');
    //Ruta para tareas
    Route::get('/tareas/{sprint}',[\App\Http\Controllers\TareasController::class,'index'])->name('tareas.sprint')->middleware('auth');
    Route::get("tareas/{id}/create", [\App\Http\Controllers\TareasController::class,'create'])->name('tareas.create')->middleware('auth');
    Route::post("tareas", [\App\Http\Controllers\TareasController::class,'store'])->name('tareas.store')->middleware('auth');
    Route::get("tareas/{tarea}/edit", [\App\Http\Controllers\TareasController::class,'edit'])->name('tareas.edit')->middleware('auth');
    Route::put("tareas/{tarea}", [\App\Http\Controllers\TareasController::class,'update'])->name('tareas.update')->middleware('auth');
    Route::delete("tareas/{tarea}", [\App\Http\Controllers\TareasController::class,'destroy'])->name('tareas.destroy')->middleware('auth');
    Route::get('/docs/{proyecto}',[\App\Http\Controllers\ProyectosController::class,'obtenerDocs'])->name('docs.proyecto')->middleware('auth');
    //Rutas para las reuniones
    Route::get('/reuniones/{sprint}',[\App\Http\Controllers\ReunionesController::class,'index'])->name('reuniones.sprint')->middleware('auth');
    Route::get("/reuniones/{id}/create", [\App\Http\Controllers\ReunionesController::class,'create'])->name('reuniones.create')->middleware('auth');
    Route::post("reuniones", [\App\Http\Controllers\ReunionesController::class,'store'])->name('reuniones.store')->middleware('auth');
    Route::get("reuniones/{reunion}/edit", [\App\Http\Controllers\ReunionesController::class,'edit'])->name('reuniones.edit')->middleware('auth');
    Route::put("reuniones/{reunion}", [\App\Http\Controllers\ReunionesController::class,'update'])->name('reuniones.update')->middleware('auth');
    Route::delete("reuniones/{reunion}", [\App\Http\Controllers\ReunionesController::class,'destroy'])->name('reuniones.destroy')->middleware('auth');
});





