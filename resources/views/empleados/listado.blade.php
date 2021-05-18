@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Gestión Empleado</h1>
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
                        <a href="{{route("empleados.create")}}" class="btn btn-primary" role="button"
                           aria-pressed="true"><i class="fa fa-plus-circle"> Alta Empleado</i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>email</th>
                                <th>dni</th>
                                <th>Dirección</th>
                                <th>Sueldo</th>
                                <th>telefono</th>
                                <th>departamentos</th>
                                <th>role</th>
                                <th>Jefe</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($empleados as $empleado)
                                <tr>
                                    <td>{{$empleado->nombre}}</td>
                                    <td>{{$empleado->apellidos}}</td>
                                    <td>{{$empleado->email}}</td>
                                    <td>{{$empleado->dni}}</td>
                                    <td>{{$empleado->direccion}}</td>
                                    <td>{{$empleado->sueldo}}</td>
                                    <td>{{$empleado->telefono}}</td>
                                    <td>{{$empleado->departamento->nombre}}</td>
                                    <td>@foreach($empleado["roles"] as $role)
                                            {{$role->name}}
                                        @endforeach
                                    </td>
                                    <td>{{$empleado->jefe->nombre}}</td>
                                    <td><a href="{{route("empleados.edit",$empleado)}}" class="btn btn-primary"
                                           role="button" aria-pressed="true"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <form action="{{route("empleados.destroy",$empleado)}}" method="post">
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
@stop
