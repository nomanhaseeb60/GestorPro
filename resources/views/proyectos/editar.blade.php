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
                <h3 class="card-title">Modificar Proyecto</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div>
                        <form role="form" method="post" action="{{route("proyectos.update",$proyecto)}}"  enctype="multipart/form-data">
                            <input id="max_id" type="hidden" name="MAX_FILE_SIZE" value="1000000000"/>
                            @csrf
                            @method("PUT")
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{$proyecto->nombre}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea id="" name="descripcion" rows="4" cols="50" class="form-control">
                                        {{$proyecto->descripcion}}
                                    </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha_inicio</label>
                                            <input type="date" class="form-control" name="fecha_inicio" value="{{$proyecto->fecha_inicio}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Estado</label>
                                            <select class="form-control" id="sel1" name="estado">
                                                @if($proyecto->estado == 0)
                                                    <option value="0" selected>En ejecución</option>
                                                @endif
                                                    <option value="1">Finalizado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha_fin</label>
                                            <input type="date" class="form-control" name="fecha_fin" value="{{$proyecto->fecha_fin}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sel1">Categoria</label>
                                            <select class="form-control" id="sel1" name="categoria">
                                                @foreach($categorias as $categoria)
                                                    @if($categoria->id_categoria == $proyecto->id_categoria)
                                                        <option value="{{$categoria->nombre}}" selected>{{$categoria->nombre}}</option>
                                                    @else
                                                        <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Precio</label>
                                            <input type="number" class="form-control" name="precio" value="{{$proyecto->precio}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sel1">Cliente</label>
                                            <select class="form-control" id="sel1" name="cliente">
                                                @foreach($clientes as $cliente)
                                                    @if($cliente->id_cliente == $proyecto->id_cliente)
                                                        <option value="{{$cliente->nombre}}" selected>{{$cliente->nombre}}</option>
                                                    @else
                                                        <option value="{{$cliente->nombre}}">{{$cliente->nombre}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="docs">Subir Documentación</label>
                                        <input type="file" class="form-control-file" id="docs" name="docs">
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

