@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Clientes</h1>
@stop
@section('content')
    @isset($msj)
        <div class="alert alert-primary" role="alert">
            {{$msj}}
        </div>
    @endisset
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route("clientes.create")}}" class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-plus-circle">Alta Cliente</i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Dni</th>
                                <th>Correo electronico</th>
                                <th>Dirección</th>
                                <th>Telefono</th>
                                <th>Ciudad</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombre}}</td>
                                    <td>{{$cliente->apellidos}}</td>
                                    <td>{{$cliente->dni}}</td>
                                    <td>{{$cliente->correo}}</td>
                                    <td>{{$cliente->direccion}}</td>
                                    <td>{{$cliente->telefono}}</td>
                                    <td>{{$cliente->ciudad}}</td>
                                    <td><a href="{{route("clientes.edit",$cliente)}}" class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                    <td><form action="{{route("clientes.destroy",$cliente)}}" method="post">
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i></button>
                                            @csrf
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
@stop
