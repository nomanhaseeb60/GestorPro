@extends('adminlte::page')
@section('title', 'Dashboard')
@role('administrador')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                themeSystem: 'bootstrap3',
                contentHeight:"auto",
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames:['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                dayNamesShort:['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                header: {
                    left: 'prev,next,hoy',
                    center: 'title'
                },
                locale: 'es',
                height: 550,
                // put your options and callbacks here
                events : [
                        @foreach($reuniones as $reunion)
                    {
                        title : '{{ $reunion->nombre }}',
                        start : '{{$reunion->fecha}}'
                    },
                    @endforeach
                ]
            })
        });
    </script>
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
        <div id='calendar'></div>
    </div>
@stop
@endrole

