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
                <h3 class="card-title">Crear Proyecto</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div>
                        <form role="form" method="post" action="{{route("proyectos.store")}}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" name="nombre">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea id="" name="descripcion" rows="4" cols="50" class="form-control">
                                    </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha_inicio</label>
                                            <input type="date" class="form-control" name="fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha_fin</label>
                                            <input type="date" class="form-control" name="fecha_fin">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sel1">Categoria</label>
                                            <select class="form-control" id="sel1" name="categoria">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Precio</label>
                                            <input type="number" class="form-control" name="precio">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sel1">Cliente</label>
                                            <select class="form-control" id="sel1" name="cliente">
                                                @foreach($clientes as $cliente)
                                                    <option value="{{$cliente->nombre}}">{{$cliente->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div></div></div>
        </div></div>
@stop

