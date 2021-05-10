<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Tabla departamentos
         */

        Schema::create('departamentos', function (Blueprint $table) {
            $table->id('dept_id')->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });
        /**
         * Tabla empleados
         */
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado')->autoIncrement();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('dni');
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->string('direccion')->nullable();
            $table->double('sueldo')->nullable();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->string('ciudad');
            $table->rememberToken();
            $table->timestamps();
            //clave foranea
            $table->unsignedBigInteger('dept_id');
            $table->foreign('dept_id')->references('dept_id')->on('departamentos');
            $table->unsignedBigInteger('id_jefe');
            $table->foreign('id_jefe')->references('id_empleado')->on('empleados');
        });

        /**
         *
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('empleados');
    }
}
