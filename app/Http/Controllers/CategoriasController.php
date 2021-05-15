<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::all();
        return view("categorias.listado",["categorias" => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //devolver la vista para crear las categorias
        return view("categorias.nuevo");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar la categoria
        $this->getValidate();
        //recibir si no ha habido ningun error
        $categoria = new Categorias($request->input());
        $categoria->saveOrFail();
        $categorias = Categorias::all();
        return view("categorias.listado",["categorias" => $categorias, "msj" => "se ha creado la categoria $categoria->nombre correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorias $categoria)
    {
        //devolver la vista para la categoria
        return view("categorias.modificar",["categoria"=>$categoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorias $categoria)
    {
        //actualizar la categoria
        $this->getValidate_update($categoria);
        //Actualizar los registros
        $categoria->fill($request->input())->saveOrFail();
        $categorias = Categorias::all();
        return view("categorias.listado",["categorias"=>$categorias, "msj"=>"La categoria $categoria->nombre se ha actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorias $categoria)
    {
        //borrar la categoria selecionada
        $categoria->delete();
        $categorias = Categorias::all();
        return view("categorias.listado",["categorias"=>$categorias, "msj"=>"La categoria $categoria->nombre se ha borrado correctamente"]);
    }
    public function getValidate_update(Categorias $categoria): void
    {
        /*Comprobacion de los datos*/
        $this->validate(request(), [
            'nombre' =>
                array(
                    'required',
                    Rule::unique('categorias')->ignore($categoria->id_categoria, 'id_categoria'),
                ),
            'descripcion' =>
                array(
                    'required'
                )
        ], $messages = [
            'required' => ':attribute es obligatorio',
            'unique' => 'La categoria exsiste'
        ]);
    }
    public function getValidate(): void
    {
        /*Comprobacion de los datos*/
        $this->validate(request(), [
            'nombre' =>
                array(
                    'required',
                    'unique:categorias'
                ),
            'descripcion' =>
                array(
                    'required'
                )
        ], $messages = [
            'required' => ':attribute es obligatorio',
            'unique' => 'La categoria exsiste'
        ]);
    }
}
