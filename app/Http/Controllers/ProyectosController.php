<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Clientes;
use App\Models\Proyectos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Consultas para tarejas
        $totalpro = Proyectos::all()->count();
        $proej = DB::table('proyectos')->select('id')->where('estado',0)->count();
        $proter = DB::table('proyectos')->select('id')->where('estado',1)->count();
        //Mostrar todos los proyectos
        $proyectos = Proyectos::all();
        return view("proyectos.listado",["proyectos" => $proyectos,"cuentapro" => $totalpro,"proej"=>$proej,"proter"=>$proter]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Clientes y categorias
        $clientes = Clientes::all();
        $categorias = Categorias::all();
        //Sacar el formulario para registrar un proyecto
        return view("proyectos.nuevo",["clientes" => $clientes,"categorias" => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar los campos
        $this->getValidate();
        //Cargar los datos
        $proyecto = new Proyectos();
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_finalizacion = $request->fecha_fin;
        $proyecto->id_categoria = DB::table('categorias')->select('id_categoria')
            ->where('nombre',"$request->categoria")->pluck('id_categoria')[0];
        $proyecto->estado = 0;//el proyecto se crea con el estado 0 "en ejecucion"
        $proyecto->precio = $request->precio;
        $proyecto->id_cliente = DB::table('clientes')->select('id_cliente')
            ->where('nombre',"$request->cliente")->pluck('id_cliente')[0];
        //Crear la carpeta en Docs-proyectos
        $nombreCarpeta = "$proyecto->nombre-$proyecto->fecha_inicio";
        Storage::makeDirectory("Docs-proyectos/$nombreCarpeta");
        //guardar la ruta en la base de datos
        $proyecto->carpetaDocumentacion = $nombreCarpeta;
        //Devolver la vista con los datos
        $proyecto->save();
        $totalpro = Proyectos::all()->count();
        $proej = DB::table('proyectos')->select('id')->where('estado',0)->count();
        $proter = DB::table('proyectos')->select('id')->where('estado',1)->count();
        //Mostrar todos los proyectos
        $proyectos = Proyectos::all();
        return view("proyectos.listado",["proyectos" => $proyectos,"cuentapro" => $totalpro,"proej"=>$proej,"proter"=>$proter,"msj" => "El proyecto $proyecto->nombre se ha insertado."]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyectos  $proyectos
     * @return \Illuminate\Http\Response
     */
    public function show(Proyectos $proyectos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyectos  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyectos $proyecto)
    {
        //Formulario para editar el proyecto
        //Clientes y categorias
        $clientes = Clientes::all();
        $categorias = Categorias::all();
        //Sacar el formulario para registrar un proyecto
        return view("proyectos.editar",["proyecto" => $proyecto,"clientes" => $clientes,"categorias" => $categorias]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyectos  $proyectos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos $proyecto)
    {
        //Recoger los datos del proyectos
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        if($request->estado == 1){
            $proyecto->fecha_finalizacion = date('Y-m-d');
        }else{
            $proyecto->fecha_finalizacion = $request->fecha_fin;
        }
        $proyecto->id_categoria = DB::table('categorias')->select('id_categoria')
            ->where('nombre',"$request->categoria")->pluck('id_categoria')[0];
        $proyecto->estado = $request->estado;//el proyecto se crea con el estado 0 "en ejecucion"
        $proyecto->precio = $request->precio;
        $proyecto->id_cliente = DB::table('clientes')->select('id_cliente')
            ->where('nombre',"$request->cliente")->pluck('id_cliente')[0];
        $image_path = $request->file('docs');//recoger el fichero
        if($image_path){
            //esto se hace para no duplicar
            $image_path_full = time().$image_path->getClientOriginalName();
            //selecionar el disco y con el metedo put poner en la carpeta de users que esta en el storage
            Storage::disk('public')->put("$proyecto->carpetaDocumentacion/$image_path_full",File::get($image_path));
        }
        //Guardar lo actualizado en la base de datos
        $proyecto->save();
        //Consultas para tarejas
        $totalpro = Proyectos::all()->count();
        $proej = DB::table('proyectos')->select('id')->where('estado',0)->count();
        $proter = DB::table('proyectos')->select('id')->where('estado',1)->count();
        //Mostrar todos los proyectos
        $proyectos = Proyectos::all();
        return view("proyectos.listado",["proyectos" => $proyectos,"cuentapro" => $totalpro,"proej"=>$proej,"proter"=>$proter,"msj" => "El proyecto $proyecto->nombre se ha actualizado."]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyectos  $proyectos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyectos $proyecto)
    {
        $proyecto->delete();
        //borrar un proyecto
        //Borrar la carpeta del proyecto
        Storage::disk('public')->deleteDirectory("$proyecto->carpetaDocumentacion");
        //Consultas para tarejas
        $totalpro = Proyectos::all()->count();
        $proej = DB::table('proyectos')->select('id')->where('estado',0)->count();
        $proter = DB::table('proyectos')->select('id')->where('estado',1)->count();
        $proyectos = Proyectos::all();
        return view("proyectos.listado",["proyectos" => $proyectos,"cuentapro" => $totalpro,"proej"=>$proej,"proter"=>$proter,"msj" => "El proyecto $proyecto->nombre se ha borrado."]);

    }

    public function obtenerDocs(Proyectos $proyecto){
        //Guardar todos los ficheros
        $ficheros = Storage::disk('public')->allFiles($proyecto->carpetaDocumentacion);
        //Borrar la carpeta de la documentación

        return view("proyectos.docs",["ficheros"=>$ficheros,"proyecto"=>$proyecto]);
    }

    public function getValidate(): void
    {
        $this->validate(request(), [
            'nombre' => array('required', 'unique:proyectos'),
            'descripcion' => array('required'),
            'fecha_inicio' => array('required'),
            'fecha_fin' => array('after_or_equal:fecha_inicio'),
            'categoria' => array('required'),
            'precio' => array('required'),
            'cliente' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'regex' => 'El campo :attribute no es valido',
            'unique' => 'El departamento ya exsiste',
            'after_or_equal'=>'La fecha finalizacion debe ser posterior a la fecha inicial.'
        ]);
    }
    public function getValidateUpdate(Proyectos $proyecto): void
    {
        $this->validate(request(), [
            'nombre' => array('required', Rule::unique('proyectos')->ignore($proyecto->id_proyecto, 'id_proyecto')),
            'descripcion' => array('required'),
            'fecha_inicio' => array('required'),
            'fecha_fin' => array('after_or_equal:fecha_inicio'),
            'categoria' => array('required'),
            'precio' => array('required'),
            'cliente' => array('required')
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'regex' => 'El campo :attribute no es valido',
            'unique' => 'El departamento ya exsiste',
            'after_or_equal'=>'La fecha finalizacion debe ser posterior a la fecha inicial.'
        ]);
    }

}
