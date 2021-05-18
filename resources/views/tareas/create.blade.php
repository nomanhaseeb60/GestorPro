@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@stop
@section('content')
    <a href="{{route("tareas.sprint",$sprint->id_sprint)}}">
        <img style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px;" alt="Qries" src="{{asset("image/atras.png")}}"></a>
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
                <h3 class="card-title">Crear Tarea</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div>
                        <form role="form" method="post" action="{{route("tareas.store")}}">
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha asignacion</label>
                                            <input type="date" class="form-control" name="fecha_comienzo">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sel1">Empleados</label>
                                            <select class="form-control" id="sel1" name="empleado">
                                                @foreach($empleados as $empleado)
                                                    @if($empleado->roles[0]->name == "programador")
                                                        <option value="{{$empleado->id_empleado}}">{{$empleado->nombre}}-{{$empleado->apellidos}}</option>
                                                    @endif
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

