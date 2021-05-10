<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Proyectos;
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
        //devolver a la vista
        return view('home',["num_clientes" => $clientes, "num_pro" => $proyectos, "empleados" => $empleados,"total" => $ingresos]);
    }

    /**
     *
     */
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
