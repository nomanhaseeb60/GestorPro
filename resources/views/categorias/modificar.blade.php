@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@stop
@section('content')
    <div class="container-md">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Modificar Categoria</h3>
            </div>
            <form role="form" action="{{route("categorias.update",$categoria)}}" method="post">
                @csrf
                @method("PUT")
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{$categoria->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="des">Descripcion</label><br>
                        <textarea class="form-control" id="des" name="descripcion" rows="3">{{$categoria->descripcion}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form></div></div>
@stop

