<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Tabla categorias*/
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('id_categoria')->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        /*Tabla proyectos*/
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('id_proyecto')->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion')->nullable();
            $table->double('precio')->nullable();
            $table->tinyInteger('estado');
            $table->string('carpetaDocumentacion');//ruta a storage
            $table->timestamps(false);

            //clave foraneas
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
        });

        /*Tabla sprints*/
        Schema::create('sprints', function (Blueprint $table) {
            $table->id('id_sprint')->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('horas')->nullable();
            $table->tinyInteger('estado');
            $table->date('fecha_comienzo');
            $table->date('fecha_finalizacion')->nullable();
            $table->timestamps();

            //clave foraneas
            $table->unsignedBigInteger('id_proyecto');
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyectos')->onDelete('cascade');
        });

        /*Tabla reuniones*/
        Schema::create('reuniones', function (Blueprint $table) {
            $table->id('id_reunion')->autoIncrement();
            $table->date('fecha');
            $table->string('notas')->nullable();
            $table->string('preguntas')->nullable();
            $table->timestamps();

            //clave foraneas
            $table->unsignedBigInteger('id_sprint');
            $table->foreign('id_sprint')->references('id_sprint')->on('sprints')->onDelete('cascade');
        });

        /*Tabla tareas*/
        Schema::create('tareas', function (Blueprint $table) {
            $table->id('id_tarea')->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_asignacion');
            $table->tinyInteger('estado');
            $table->string('fecha_finalizacion')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();

            //clave foraneas
            $table->unsignedBigInteger('id_sprint');
            $table->foreign('id_sprint')->references('id_sprint')->on('sprints')->onDelete('cascade');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('sprints');
        Schema::dropIfExists('reuniones');
        Schema::dropIfExists('tareas');
    }
}
