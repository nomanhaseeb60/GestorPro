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
                <h3 class="card-title">Alta Empleado</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{route("empleados.store")}}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" name="nombre">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dni</label>
                                    <input type="text" class="form-control" name="dni">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jefe</label>
                                    <select class="form-control" id="sel1" name="jefe">
                                        @foreach($empleados as $empleado)
                                            <option value="{{$empleado}}">{{$empleado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sel1">Departamento</label>
                                            <select class="form-control" id="sel1" name="departamento">
                                                @foreach($departamentos as $departamento)
                                                    <option value="{{$departamento}}">{{$departamento}}</option>
                                                @endforeach
                                            </select>
                                        </div></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sel1">Rol</label>
                                            <select class="form-control" id="sel1" name="role">
                                                @foreach($roles as $role)
                                                    <option value="{{$role}}">{{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sueldo</label>
                                            <input type="number" step="0.01" class="form-control" name="sueldo">
                                        </div></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" name="fecha_nacimiento">
                                        </div></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <input type="text" class="form-control" name="direccion">
                                        </div></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ciudad</label>
                                            <input type="text" class="form-control" name="ciudad">
                                        </div></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telefono</label>
                                            <input type="text" class="form-control" name="telefono">
                                        </div></div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div></div></div>
        </div></div>
@stop

