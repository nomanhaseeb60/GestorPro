@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h2>Sprints {{$proyecto->nombre}}</h2>
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
                    <a href="{{route("sprint.create",['id'=>$proyecto->id_proyecto])}}" class="btn btn-primary" role="button"
                       aria-pressed="true"><i class="fa fa-plus-circle"> Crear Sprint</i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Fecha comienzo</th>
                            <th>Fecha finalizacion</th>
                            <th>Horas</th>
                            <th>Estado</th>
                            <th>Tareas</th>
                            <th>Reuniones</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sprints as $sprint)
                            <tr>
                                <td>{{$sprint->nombre}}</td>
                                <td>{{$sprint->descripcion}}</td>
                                <td>{{$sprint->fecha_comienzo}}</td>
                                <td>{{$sprint->fecha_finalizacion}}</td>
                                <td>{{$sprint->horas}}</td>
                                <td>@if($sprint->estado == 1)
                                        <span class="badge badge-pill badge-success">Finalizado</span>
                                    @else
                                        <span class="badge badge-pill badge-info">En ejecución</span>
                                    @endif
                                </td>
                                <td><a href="{{route("tareas.sprint",['sprint'=>$sprint])}}"><span class="badge badge-pill badge-info">tareas</span></a></td>
                                <td><a href=""><span class="badge badge-pill badge-dark">Reuniones</span></a></td>
                                <td><a href="{{route("sprint.edit",['sprint'=>$sprint])}}" class="btn btn-primary"
                                       role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="{{route("sprint.destroy",['sprint'=>$sprint])}}" method="post">
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

