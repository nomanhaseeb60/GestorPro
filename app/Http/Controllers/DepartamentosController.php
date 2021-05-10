<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamentos::all();
        return view("departamentos.listado",["departamentos" => $departamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //devolver la vista para crear un departamento
        return view("departamentos.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Comprobar el departamento
        $this->getValidate();
        //guardar el departamento en la base de datos
        $departamento = new Departamentos($request->input());
        $departamento->saveOrFail();
        $departamentos = Departamentos::all();
        return view("departamentos.listado",["departamentos" => $departamentos, "msj" => "El departamento $departamento->nombre se ha creado."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamentos  $departamentos
     * @return \Illuminate\Http\Response
     */
    public function show(Departamentos $departamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamentos  $departamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamentos $departamento)
    {
        //devolver la vista para editar un departamento
        return view("departamentos.modificar",["departamento" =>$departamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamentos  $departamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamentos $departamento)
    {
        $this->validarDepartamentoUpdate($departamento);
        $departamento->fill($request->input())->saveOrFail();
        $departamentos = Departamentos::all();
        return view("departamentos.listado",["departamentos" =>$departamentos,"msj"=>"El departamento $departamento->nombre se ha actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamentos  $departamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamentos $departamento)
    {
        //Borrar departamento
        $departamento->delete();
        $departamentos = Departamentos::all();
        return view("departamentos.listado",["departamentos"=>$departamentos,"msj"=>"El departamento $departamento->no
         se ha borrado"]);
    }
    /**\
     * Esta función consiste en validar los datos de entrada al sistema
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getValidate(): void
    {
        /*Comprobacion de los datos*/
        $this->validate(request(), [
            'nombre' =>
                array(
                    'required',
                    'unique:departamentos'
                ),
            'descripcion' =>
                array(
                    'required'
                )
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'regex' => 'El campo :attribute no es valido',
            'unique' => 'El departamento ya exsiste'
        ]);
    }

    /**
     * @param Departamentos $departamento
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validarDepartamentoUpdate(Departamentos $departamento): void
    {
        //Comprobar el departamento
        $this->validate(request(), [
            'nombre' =>
                array(
                    'required',
                    Rule::unique('departamentos')->ignore($departamento->dept_id, 'dept_id'),
                ),
            'descripcion' =>
                array(
                    'required'
                )
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'regex' => 'El campo :attribute no es valido',
            'unique' => 'El departamento ya exsiste'
        ]);
    }
}
