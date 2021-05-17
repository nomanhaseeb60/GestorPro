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
                <h3 class="card-title">Modificar Empleado</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{route("empleados.update",[$emp])}}">
                            @csrf
                            @method("PUT")
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{$emp->nombre}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" value="{{$emp->apellidos}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$emp->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dni</label>
                                    <input type="text" class="form-control" name="dni" value="{{$emp->dni}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jefe</label>
                                    <select class="form-control" id="sel1" name="jefe">
                                        @foreach($empleados as $empleado)
                                            @if($emp->id_jefe == $empleado->id_empleado)
                                                <option value="{{$empleado->nombre}}" selected>{{$empleado->nombre}}</option>
                                            @else
                                                <option value="{{$empleado->nombre}}">{{$empleado->nombre}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sel1">Departamento</label>
                                            <select class="form-control" id="sel1" name="departamento">
                                                @foreach($departamentos as $departamento)
                                                    @if($departamento->dept_id == $emp->dept_id)
                                                        <option value="{{$departamento->nombre}}" selected>{{$departamento->nombre}}</option>
                                                    @else
                                                        <option value="{{$departamento->nombre}}">{{$departamento->nombre}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sel1">Rol</label>
                                            <select class="form-control" id="sel1" name="role">
                                                @foreach($roles as $role)
                                                        @if($role->name == $emp->hasRole("$role->name"))
                                                        <option value="{{$role->name}}" selected>{{$role->name}}</option>
                                                    @else
                                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div></div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sueldo</label>
                                            <input type="number" step="0.01" class="form-control" name="sueldo" value="{{$emp->sueldo}}">
                                        </div></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" name="fecha_nacimiento" value="{{$emp->fecha_nacimiento}}">
                                        </div></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" value="{{$emp->direccion}}">
                                        </div></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ciudad</label>
                                            <input type="text" class="form-control" name="ciudad" value="{{$emp->ciudad}}">
                                        </div></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telefono</label>
                                            <input type="text" class="form-control" name="telefono" value="{{$emp->telefono}}">
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

