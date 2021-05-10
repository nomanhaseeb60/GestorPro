<?php

namespace Database\Factories;

use App\Models\Tareas;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TareasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tareas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => 'Tarea crear base de datos',
            'descripcion' => 'Esta tarea consiste en crear la base de datos',
            'fecha_asignacion' => Carbon::create('2020','12','12'),
            'id_sprint' => 1,
            'id_empleado' => 1
        ];
    }
}
