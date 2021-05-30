<?php

namespace App\Http\Controllers;

use App\Models\Sprints;
use App\Models\Tareas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //Sacar todos los empleados para listar
        $empleados = User::with('roles')->get();
        $sprint = Session::get('sprint');
        return view("tareas.create",["empleados"=>$empleados,"sprint"=>$sprint]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sprint = Session::get('sprint');
        //Validar los datos que llegan por los request
        $this->validar();
        //Guardar y validar el request que me viene
        $tarea = new Tareas();
        //Guardar en la base de datos
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_asignacion = $request->fecha_comienzo;
        $tarea->id_empleado = $request->empleado;
        $tarea->id_sprint = $sprint->id_sprint;
        //Por defecto la tarea   se crea en ejecución
        $tarea->estado =0;
        //guardar
        $tarea->saveOrFail();
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        $tareas = Tareas::all()->where("id_sprint",$sprint->id_sprint);
        return view("tareas.listado",["tareas"=>$tareas,"sprint"=>$sprint,"id"=>$project_id,"msj"=>"La tarea $tarea->nombre se ha creado."]);
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
     * @param  \App\Models\Tareas  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tareas $tarea)
    {
        //Mandar el formulario para editar la tarea
        $sprint = Session::get('sprint');
        $empleados = User::with('roles')->get();
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        return view("tareas.edit",["sprint"=>$sprint,"id"=>$project_id,"tarea"=>$tarea,"empleados"=>$empleados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tareas $tarea)
    {
        $sprint = Session::get('sprint');
        //Validar los datos que llegan por los request
        $this->getValidateUpdate();
        //Guardar en la base de datos
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_asignacion = $request->fecha_comienzo;
        $tarea->id_empleado = $request->empleado;
        $tarea->id_sprint = $sprint->id_sprint;
        //Por defecto la tarea   se crea en ejecución
        $tarea->estado = $request->estado;
        //guardar en la base de datos
        $tarea->saveOrFail();
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        $tareas = Tareas::all()->where("id_sprint",$sprint->id_sprint);
        return view("tareas.listado",["tareas"=>$tareas,"sprint"=>$sprint,"id"=>$project_id,"msj"=>"La tarea $tarea->nombre se ha actualizado."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tareas $tarea)
    {
        $sprint = Session::get('sprint');
        //Borrar la tarea creada
        $tarea->delete();
        $project_id = DB::table('sprints')->where('id_sprint',$sprint->id_sprint)->get('id_proyecto')[0];
        $tareas = Tareas::all()->where("id_sprint",$sprint->id_sprint);
        return view("tareas.listado",["tareas"=>$tareas,"sprint"=>$sprint,"id"=>$project_id,"msj"=>"La tarea $tarea->nombre se ha borrado."]);
    }

    /**
     * Validar las tareas
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validar(){
        $this->validate(request(), [
            'nombre' => array('required'),
            'descripcion' => array('required'),
            'fecha_comienzo' => array('required'),
            'empleado' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio'
        ]);
    }

    public function getValidateUpdate(): void
    {
        $this->validate(request(), [
            'nombre' => array('required'),
            'descripcion' => array('required'),
            'fecha_comienzo' => array('required'),
            'empleado' => array('required'),
            'estado' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio'
        ]);
    }

    /**
     * Devolver la vista para editar el estado de las tareas
     */
    public function programador(Request $request,Tareas $tarea){
        $tarea = Tareas::all()->where('id_tarea',$request->tar);
        return view("programador.editarTarea",["tarea" => $tarea]);
    }

    /**
     * Modificar el estado y observacion
     */

    public function modificarTarea(Request $request,Tareas $tarea){
        $this->validate(request(), [
            'observacion' => array('required'),
            'estado' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio'
        ]);
        $tarea = Tareas::find($request->id_tarea);
        $tarea->observacion = $request->observacion;
        $tarea->estado = $request->estado;
        $tarea->fecha_finalizacion = date('Y-m-d');
        $tarea->save();
        //guardar en la base de datos
        $ctarea = Tareas::all()->where('id_empleado',Auth::user()->id_empleado)->count();
        $ctarea_ejecucion = Tareas::all()->where('id_empleado',Auth::user()->id_empleado)->where('estado',0)->count();
        $ctarea_finalizada = Tareas::all()->where('id_empleado',Auth::user()->id_empleado)->where('estado',1)->count();
        $tareas = Tareas::all()->where('id_empleado',Auth::user()->id_empleado);
        return view("programador.home",["tarea_finalizadas"=>$ctarea_finalizada ?? "","num_clientes" => $clientes ?? "", "num_pro" => $proyectos ?? "", "empleados" => $empleados ?? "","total" => $ingresos ?? "","tareas"=>$tareas?? "","totaltarea"=>$ctarea ?? "","tareas_ejec"=>$ctarea_ejecucion ?? ""]);

    }
}
