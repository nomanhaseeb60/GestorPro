<?php

namespace Database\Factories;

use App\Models\Reuniones;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReunionesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reuniones::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'fecha' => Carbon::create('2021','02','12'),
            'notas' => '',
            'preguntas' => '',
            'id_sprint' => 1
        ];
    }
}
