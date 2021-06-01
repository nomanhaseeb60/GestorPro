@extends('adminlte::page')
@section('title', 'Reuniones')
@section('content')
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
                        start : '{{$reunion->fecha}}',
                        url : '{{route('reuniones.edit',[$reunion])}}'
                    },
                    @endforeach
                ]
            })
        });
    </script>
@stop

<a href="{{route("sprint.proyectos",$id->id_proyecto)}}">
    <img style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px;" alt="Qries" src="{{asset("image/atras.png")}}"></a>
<div class="container-sm ">
    <h2 style="text-align: center; padding-bottom: 15px">Reuniones de {{$sprint->nombre}}</h2>
    @isset($msj)
        <div class="alert alert-primary" role="alert">
            {{$msj}}
        </div>
    @endisset
    <a href="{{route("reuniones.create",$sprint)}}" class="btn btn-primary" role="button"
       aria-pressed="true"><i class="fa fa-plus-circle"></i> Agendar Reunión</a>
        <div id='calendar'></div>
</div>
@stop
