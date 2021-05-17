<?php

namespace App\Http\Controllers;

use App\Models\Sprints;
use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sprints $sprint)
    {
        //Cargar todas las tareas del sprint
        //Session del sprint
        Session::put('sprint',$sprint);
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        $tareas = Tareas::all()->where("id_sprint",$sprint->id_sprint);
        return view("tareas.listado",["tareas"=>$tareas,"sprint"=>$sprint,"id"=>$project_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Devovler la vista para crear una tarea

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function show(Tareas $tareas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function edit(Tareas $tareas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tareas $tareas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tareas $tareas)
    {
        //
    }
}
