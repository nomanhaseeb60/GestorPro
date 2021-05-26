<?php

namespace App\Http\Controllers;

use App\Models\Reuniones;
use App\Models\Sprints;
use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ReunionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sprints $sprint)
    {
        //Mandar por la vista todas las reuniones en el sprint
        Session::put('sprint',$sprint);
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        $reuniones = Reuniones::all()->where("id_sprint",$sprint->id_sprint);
        return view("reuniones.listado",["reuniones"=>$reuniones,"sprint"=>$sprint,"id"=>$project_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Mostrar el formulario para crear una reunion.
        $sprint = Session::get('sprint');
        return view('reuniones.create',["sprint"=>$sprint]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardar la reunion
        $this->validar();
        $sprint = Session::get('sprint');
        $reunion = new Reuniones();
        $reunion->nombre = $request->nombre;
        $reunion->fecha = $request->fecha;
        $reunion->notas = $request->notas;
        $reunion->id_sprint = $sprint->id_sprint;
        //Alamcenar en la base de datos
        $reunion->saveOrFail();
        //Devolver a la vista
        $reuniones = Reuniones::all()->where("id_sprint",$sprint->id_sprint);
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        return view("reuniones.listado",["id"=>$project_id,"reuniones"=>$reuniones,"sprint"=>$sprint,"msj" => "Se ha creado la reunion correctamente."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reuniones  $reuniones
     * @return \Illuminate\Http\Response
     */
    public function show(Reuniones $reuniones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reuniones  $reuniones
     * @return \Illuminate\Http\Response
     */
    public function edit(Reuniones $reunion)
    {
        //
        $sprint = Session::get('sprint');
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        return view("reuniones.editar",["sprint"=>$sprint,"id"=>$project_id,"reunion"=>$reunion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reuniones  $reuniones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reuniones $reunion)
    {
        //Actualizar la reunion que me llega por el post
        $this->validar();
        $reunion->fill($request->input())->saveOrFail();
        $sprint = Session::get('sprint');
        $reuniones = Reuniones::all()->where("id_sprint",$sprint->id_sprint);
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        return view("reuniones.listado",["id"=>$project_id,"reuniones"=>$reuniones,"sprint"=>$sprint,"msj" => "Se ha actualizado la reunion correctamente."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reuniones  $reuniones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reuniones $reunion)
    {
        //Borrar una reunion
        $reunion->delete();
        $sprint = Session::get('sprint');
        $reuniones = Reuniones::all()->where("id_sprint",$sprint->id_sprint);
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        return view("reuniones.listado",["id"=>$project_id,"reuniones"=>$reuniones,"sprint"=>$sprint,"msj" => "Se ha borrado la reunion correctamente."]);
    }

    /**
     * Validar los datos o el request que me llega
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validar(){
        $this->validate(request(), [
            'nombre' => array('required'),
            'fecha' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio'
        ]);
    }

}
