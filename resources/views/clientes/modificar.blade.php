@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')

@stop
@section('content')
    <div class="container-md">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Modificar Cliente</h3>
            </div>
            <form role="form" action="{{route("clientes.update",$cliente)}}" method="post">
                @csrf
                @method("PUT")
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{$cliente->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="{{$cliente->apellidos}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dni</label>
                        <input type="text" class="form-control" name="dni" value="{{$cliente->dni}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="email" class="form-control" name="correo" value="{{$cliente->correo}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefono</label>
                        <input type="text" class="form-control" name="telefono" value="{{$cliente->telefono}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{$cliente->direccion}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" value="{{$cliente->ciudad}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form></div></div>
@stop

