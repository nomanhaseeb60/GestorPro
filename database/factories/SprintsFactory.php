<?php

namespace Database\Factories;

use App\Models\Sprints;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprintsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sprints::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => 'Sprint Funcionalidad reuniones',
            'descripcion' => 'En esta funcionalidad se va crear toda la funcionalidad relacionada con la funcionalidad de los reuniones',
            'horas' => 20,
            'estado' => false,
            'fecha_comienzo' => Carbon::create('2020','12','12'),
            'id_proyecto' => 1
        ];
    }
}
