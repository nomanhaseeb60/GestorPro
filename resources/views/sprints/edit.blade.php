@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@stop
@section('content')
    <a href="{{route("sprint.proyectos",["proyecto"=>$id])}}">
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
                <h3 class="card-title">Modificar Sprint</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div>
                        <form role="form" method="post" action="{{route("sprint.update",['sprint'=>$sprint])}}">
                            @csrf
                            @method("PUT")
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{$sprint->nombre}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea id="" name="descripcion" rows="4" cols="50" class="form-control">
                                        {{$sprint->descripcion}}
                                    </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha_comienzo</label>
                                            <input type="date" class="form-control" name="fecha_comienzo" value="{{$sprint->fecha_comienzo}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha_finalizacion</label>
                                            <input type="date" class="form-control" name="fecha_finalizacion" value="{{$sprint->fecha_finalizacion}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sel1">Horas</label>
                                            <input type="number" class="form-control" name="horas" value="{{$sprint->horas}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sel1">Estado</label>
                                            <select class="form-control" id="sel1" name="estado">
                                                <option value="0" selected>En ejecucion</option>
                                                <option value="1">Finalizado</option>
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

