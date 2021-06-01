<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Proyectos;
use App\Models\Reuniones;
use App\Models\Tareas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Numero de clientes, proyectos, y el total de ingresos
        $clientes = Clientes::all()->count();
        $proyectos = Proyectos::all()->count();
        $empleados = User::all()->count();
        $ingresos = DB::table('proyectos')
            ->select(DB::raw('sum(precio) as total'))
            ->get();
        $vista = "home";
        $reuniones = Reuniones::all();
        //Devolver todas las tareas si es programador el que esta autenticado
        if(Auth::user()->roles[0]->name == "programador"){
            //total tareas
            $ctarea = Tareas::all()->where('id_empleado',Auth::user()->id_empleado)->count();
            $ctarea_ejecucion = Tareas::all()->where('id_empleado',Auth::user()->id_empleado)->where('estado',0)->count();
            $ctarea_finalizada = Tareas::all()->where('id_empleado',Auth::user()->id_empleado)->where('estado',1)->count();
            $tareas = Tareas::all()->where('id_empleado',Auth::user()->id_empleado);
            $vista = "programador.home";
        }

        //devolver a la vista
        return view("$vista",["reuniones"=>$reuniones ?? "","tarea_finalizadas"=>$ctarea_finalizada ?? "","num_clientes" => $clientes ?? "", "num_pro" => $proyectos ?? "", "empleados" => $empleados ?? "","total" => $ingresos ?? "","tareas"=>$tareas?? "","totaltarea"=>$ctarea ?? "","tareas_ejec"=>$ctarea_ejecucion ?? ""]);
    }

    /**
     *
     */
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
