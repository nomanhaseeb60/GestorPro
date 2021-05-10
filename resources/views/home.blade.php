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
                        <h3>44</h3>
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
                        <h3>150</h3>
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
                        <h3>44</h3>
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
                        <h3>44000€</h3>
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
    <h1>Bienvenido {{auth()->user()->nombre}}</h1>
@stop
@section('content')

@stop
@endrole
