@role('programador')
@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@stop
@section('content')
    <div class="container-md">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totaltarea}}</h3>
                        <p>Tareas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="small-box bg-gradient-lightblue">
                    <div class="inner">
                        <h3>{{$tareas_ejec}}</h3>
                        <p>Tareas en ejecución</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="small-box bg-gradient-lime">
                    <div class="inner">
                        <h3>{{$tarea_finalizadas}}</h3>
                        <p>Tareas Finalizadas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
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
                                    <th>Proyecto</th>
                                    <th>Sprint</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Reuniones</th>
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
                                        <td>{{$tarea->sprint->proyecto->nombre}}</td>
                                        <td>{{$tarea->sprint->nombre}}</td>
                                        <td>@if($tarea->estado == 1)
                                                <span class="badge badge-pill badge-success">Finalizado</span>
                                            @else
                                                <span class="badge badge-pill badge-info">En ejecución</span>
                                            @endif</td>
                                        <td><a href="{{route("tareas.programador",["tar"=>$tarea])}}" class="btn btn-primary"
                                               role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td></td>
                                        <td><a href="{{route("meetings",["tar"=>$tarea])}}" class="btn btn-primary"
                                               role="button" aria-pressed="true"><i class="fa fa-clock"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div></div></div>
@stop
@endrole
