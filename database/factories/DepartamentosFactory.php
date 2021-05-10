<?php

namespace Database\Factories;

use App\Models\Departamentos;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartamentosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Departamentos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => 'Software',
            'descripcion' => 'Es el departamento de desarollo de software, en este departamento se realizan funciones
            crear software y mantener los.'
        ];
    }
}
