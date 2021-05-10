<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mostrar todos los clientes en la vista
        $clientes = Clientes::all();
        return view("clientes.listado",["clientes" => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //devolver la vista para crear el cliente
        //devolver la vista para crear
        return view("clientes.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getValidate();
        //Guardar los valores
        $cliente = new Clientes($request->input());
        $cliente->saveOrFail();
        //recoger y devolver la vista
        $clientes = Clientes::all();
        return view("clientes.listado",['clientes'=>$clientes,'msj' => "El cliente $cliente->nombre ha sido dado de alta"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $cliente)
    {
        //Devolver la vista para editar
        return view("clientes.modificar",["cliente" => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $cliente)
    {
        $this->validarCliente_update($cliente);
        //Actualizar los registros
        $cliente->fill($request->input())->saveOrFail();
        $clientes =  Clientes::all();
        return view("clientes.listado",["clientes"=>$clientes,"msj"=>"El cliente $cliente->nombre se ha actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $cliente)
    {
        //Borrar un cliente
        $cliente->delete();
        $clientes = Clientes::all();
        return view("clientes.listado",["clientes"=> $clientes,"msj" => "El cliente $cliente->nombre se ha borrado del sistema"]);
    }

    /**
     * Esta función consiste en validar los datos de entrada al sistema
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getValidate(): void
    {
        /*Comprobacion de los datos*/
        $this->validate(request(), [
            'dni' =>
                array(
                    'required',
                    'regex:/([a-z]|[A-Z]|[0-9])[0-9]{7}([a-z]|[A-Z]|[0-9])/u',
                    'unique:clientes'
                ),
            'nombre' =>
                array(
                    'required'
                ),
            'apellidos' =>
                array(
                    'required'
                ),
            'direccion' =>
                array(
                    'required'
                ),
            'correo' =>
                array(
                    'required'
                )
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'regex' => 'El :attribute no es valido',
            'unique' => 'El cliente ya exsiste'
        ]);
    }

    /**
     * @param Clientes $cliente
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validarCliente_update(Clientes $cliente): void
    {
        //Validar la informacion de los clientes
        $this->validate(request(), [
            'dni' =>
                array(
                    'required',
                    'regex:/([a-z]|[A-Z]|[0-9])[0-9]{7}([a-z]|[A-Z]|[0-9])/u',
                    Rule::unique('clientes')->ignore($cliente->id_cliente, 'id_cliente'),
                ),
            'nombre' =>
                array(
                    'required'
                ),
            'apellidos' =>
                array(
                    'required'
                ),
            'direccion' =>
                array(
                    'required'
                ),
            'correo' =>
                array(
                    'required'
                )
        ], $messages = [
            'required' => 'El :attribute es obligatorio',
            'regex' => 'El :attribute no es valido',
            'unique' => 'El cliente ya exsiste'
        ]);
    }
}
