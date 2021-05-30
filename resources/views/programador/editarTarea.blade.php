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
                <h3 class="card-title">Modificar Tarea</h3>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{route("tareas.modificar",['tar'=>$tarea[0]])}}">
                            @csrf
                            @method("PUT")
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Observacion</label>
                                    <textarea id="" name="observacion" rows="4" cols="50" class="form-control">
                                        {{$tarea[0]->observacion}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Estado</label>
                                    <label for="sel1">Rol</label>
                                    <select class="form-control" id="sel1" name="estado">
                                        <option value="">No selecionado</option>
                                        <option value="0">En ejecucion</option>
                                        <option value="1">Finalizado</option>
                                    </select>
                                </div>
                            </div>
                            <input  name="id_tarea" type="hidden" value="{{$tarea[0]->id_tarea}}">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div></div></div>
        </div></div>
@stop

