<?php

namespace Database\Factories;

use App\Models\Proyectos;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProyectosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proyectos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => 'App-Constructor',
            'descripcion'=>'Es un proyecto web basado en las ultimas tecnologias que exsisten en el mercado',
            'fecha_inicio' => Carbon::create('2020','12','12'),
            'precio' => 12000.00,
            'estado' => false,
            'carpetaDocumentacion' => 'docs-app-constructor/',
            'id_cliente' => 1,
            'id_categoria' => 1
        ];
    }
}
