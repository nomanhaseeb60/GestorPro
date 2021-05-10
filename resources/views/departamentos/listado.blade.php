@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Gestión Departamentos</h1>
@stop
@section('content')
    @isset($msj)
        <div class="alert alert-primary" role="alert">
            {{$msj}}
        </div>
    @endisset
    <div class="container-sm">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route("departamentos.create")}}" class="btn btn-primary" role="button"
                           aria-pressed="true"><i class="fa fa-plus-circle">Crear Departamento</i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departamentos as $departamento)
                                <tr>
                                    <td>{{$departamento->nombre}}</td>
                                    <td>{{$departamento->descripcion}}</td>
                                    <td><a href="{{route("departamentos.edit",$departamento)}}" class="btn btn-primary"
                                           role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <form action="{{route("departamentos.destroy",$departamento)}}" method="post">
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i>
                                            </button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
@stop
