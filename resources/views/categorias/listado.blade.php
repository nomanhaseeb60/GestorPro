@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Categorias</h1>
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
                        <a href="{{route("categorias.create")}}" class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-plus-circle"> Crear Categoria</i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
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
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{$categoria->nombre}}</td>
                                    <td>{{$categoria->descripcion}}</td>
                                    <td><a href="{{route("categorias.edit",$categoria)}}" class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                    <td><form action="{{route("categorias.destroy",$categoria)}}" method="post">
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
