@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Gestión Proyectos</h1>
@stop
@section('content')
    <div class="container-md">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>{{$proter}}</h3>
                        <p>Proyectos Finalizados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$proej}}</h3>
                        <p>Proyectos en ejecución</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="small-box bg-gradient-lightblue">
                    <div class="inner">
                        <h3>{{$cuentapro}}</h3>
                        <p>Proyectos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
        </div>
    </div>
    </div>
    @isset($msj)
        <div class="alert alert-primary" role="alert">
            {{$msj}}
        </div>
    @endisset
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route("proyectos.create")}}" class="btn btn-primary" role="button"
                       aria-pressed="true"><i class="fa fa-plus-circle"> Crear Proyecto</i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Fecha incio</th>
                            <th>Fecha finalización</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Sprints</th>
                            <th>Docs</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($proyectos as $proyecto)
                            <tr>
                                <td>{{$proyecto->nombre}}</td>
                                <td>{{$proyecto->descripcion}}</td>
                                <td>{{$proyecto->fecha_inicio}}</td>
                                <td>{{$proyecto->fecha_finalizacion}}</td>
                                <td>{{$proyecto->precio}}</td>
                                <td>@if($proyecto->estado == 1)
                                        <span class="badge badge-pill badge-success">Finalizado</span>
                                    @else
                                        <span class="badge badge-pill badge-info">En ejecución</span>
                                    @endif
                                </td>
                                <td>{{$proyecto->cliente->nombre}}</td>
                                <td><a href="{{route("sprint.proyectos",$proyecto)}}"><span class="badge badge-pill badge-info">sprint</span></a></td>
                                <td><a href="{{route("docs.proyecto",$proyecto)}}"><span class="badge badge-pill badge-info">Docs</span></a></td>
                                <td><a href="{{route("proyectos.edit",$proyecto)}}" class="btn btn-primary"
                                       role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="{{route("proyectos.destroy",$proyecto)}}" method="post">
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

