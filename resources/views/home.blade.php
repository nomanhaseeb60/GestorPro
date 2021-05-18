@extends('adminlte::page')
@section('title', 'Dashboard')

@role('administrador')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="container-md">
        <div class="row">
            <div class="col-lg-3 col-sm-4">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>{{$num_clientes}}</h3>
                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$num_pro}}</h3>
                        <p>Proyectos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4">
                <div class="small-box bg-gradient-lightblue">
                    <div class="inner">
                        <h3>{{$empleados}}</h3>
                        <p>Empleados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4">
                <div class="small-box bg-gradient-lime">
                    <div class="inner">
                        <h3>{{($total[0]->total)}}</h3>
                        <p>Ingresos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@endrole
@role('programador')
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <!-- /.card-header -->
                        <a href="" class="btn btn-primary" role="button"
                           aria-pressed="true"><i class="fa fa-plus-circle"> Reuniones</i></a>
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
                                <th>Editar</th>
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
                                    <td><a href="" class="btn btn-primary"
                                           role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.card-body -->
                    </div>
                </div></div></div>
    </div>
@stop
@endrole
