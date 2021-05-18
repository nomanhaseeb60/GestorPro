@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <a href="{{route("sprint.proyectos",$id->id_proyecto)}}">
        <img style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px;" alt="Qries" src="{{asset("image/atras.png")}}"></a>
    <h2 style="text-align: center">Tareas de {{$sprint->nombre}}</h2>
@stop
@section('content')
    @isset($msj)
        <div class="alert alert-primary" role="alert">
            {{$msj}}
        </div>
    @endisset
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route("tareas.create",['id'=>$sprint->id_sprint])}}" class="btn btn-primary" role="button"
                       aria-pressed="true"><i class="fa fa-plus-circle">Crear Tarea</i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Fecha asignacion</th>
                            <th>Fecha finalizacion</th>
                            <th>Observacion</th>
                            <th>Estado</th>
                            <th>Empleado</th>
                            <th>Dni</th>
                            <th>Editar</th>
                            <th>orrar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tareas as $tarea)
                            <tr>
                                <td>{{$tarea->nombre}}</td>
                                <td>{{$tarea->descripcion}}</td>
                                <td>{{$tarea->fecha_asignacion}}</td>
                                <td>{{$tarea->fecha_finalizacion}}</td>
                                <td>
                                    @if($tarea->observacion == null)
                                        no tiene observación
                                    @else
                                        {{$tarea->observacion}}
                                    @endif
                                </td>
                                <td>@if($tarea->estado == 1)
                                        <span class="badge badge-pill badge-success">Finalizado</span>
                                    @else
                                        <span class="badge badge-pill badge-info">En ejecución</span>
                                    @endif</td>
                                <td>{{$tarea->empleado[0]->nombre}}</td>
                                <td>{{$tarea->empleado[0]->dni}}</td>
                                <td><a href="{{route("tareas.edit",["tarea"=>$tarea])}}" class="btn btn-primary"
                                       role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="{{route("tareas.destroy",["tarea"=>$tarea])}}" method="post">
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
                    <!-- /.card-body -->
                </div>
            </div>
@stop
