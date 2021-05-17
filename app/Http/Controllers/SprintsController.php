<?php

namespace App\Http\Controllers;

use App\Models\Proyectos;
use App\Models\Sprints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SprintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyectos $proyecto)
    {
        //Guardar en la session el proyecto
        Session::put('project',$proyecto);
        $sprints = Sprints::all()->where('id_proyecto',"$proyecto->id_proyecto");
        return view("sprints.listado",["sprints"=>$sprints,"proyecto"=>$proyecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //devolver la vista
        $project_id = Session::get('project')->id_proyecto;
        return view("sprints.nuevo",["id"=>$project_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar el sprint
        $this->getValidate();
        //guardar el sprint
        $sprint = new Sprints();
        $sprint->nombre = $request->nombre;
        $sprint->descripcion = $request->descripcion;
        $sprint->horas = $request->horas;
        $sprint->estado = 0;
        $sprint->fecha_comienzo = $request->fecha_comienzo;
        $sprint->fecha_finalizacion = $request->fecha_finalizacion;
        $proyecto = Session::get('project');
        $sprint->id_proyecto = $proyecto->id_proyecto;
        //guardar en la base de datos
        $sprint->save();
        $sprints = Sprints::all()->where('id_proyecto',"$proyecto->id_proyecto");
        return view("sprints.listado",["sprints"=>$sprints,"proyecto"=>$proyecto,"msj"=>"El sprint $sprint->nombre se ha creado."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sprints  $sprints
     * @return \Illuminate\Http\Response
     */
    public function show(Sprints $sprints)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sprints  $sprint
     * @return \Illuminate\Http\Response
     */
    public function edit(Sprints $sprint)
    {
        $project_id = Session::get('project')->id_proyecto;
        return view("sprints.edit",["id"=>$project_id,"sprint"=>$sprint]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sprints  $sprints
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sprints $sprint)
    {
        //Validar el sprint
        $this->getValidate();
        $sprint->nombre = $request->nombre;
        $sprint->descripcion = $request->descripcion;
        $sprint->horas = $request->horas;
        $sprint->estado = $request->estado;
        $sprint->fecha_comienzo = $request->fecha_comienzo;
        $sprint->fecha_finalizacion = $request->fecha_finalizacion;
        $proyecto = Session::get('project');
        $sprint->id_proyecto = $proyecto->id_proyecto;
        //guardar en la base de datos
        $sprint->save();
        $proyecto = Session::get('project');
        $sprints = Sprints::all()->where('id_proyecto',"$proyecto->id_proyecto");
        return view("sprints.listado",["sprints"=>$sprints,"proyecto"=>$proyecto,"msj"=>"El sprint $sprint->nombre se ha actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sprints  $sprints
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sprints $sprint)
    {
        //Borrar un sprint de un proyecto
        $sprint->delete();
        $proyecto = Session::get('project');
        $sprints = Sprints::all()->where('id_proyecto',"$proyecto->id_proyecto");
        return view("sprints.listado",["sprints"=>$sprints,"proyecto"=>$proyecto,"msj"=>"El sprint $sprint->nombre se ha borrado correctamente"]);
    }

    /**
     * Validar los datos del sprint
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getValidate(): void
    {
        $this->validate(request(), [
            'nombre' => array('required'),
            'descripcion' => array('required'),
            'fecha_comienzo' => array('required'),
            'fecha_finalizacion' => array('after_or_equal:fecha_inicio'),
            'horas' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'unique' => 'El sprint no se puede repitir',
            'after_or_equal'=>'La fecha finalizacion debe ser posterior a la fecha inicial.'
        ]);
    }

}
