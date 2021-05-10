<?php

namespace Database\Factories;

use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clientes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'dni' => $this->faker->dni,
            'correo' => $this->faker->email,
            'telefono'=>$this->faker->phoneNumber,
            'direccion'=>$this->faker->address,
            'ciudad' => 'Zaragoza'
        ];
    }
}
