<?php

namespace Database\Seeders;

use App\Models\Proyectos;
use Illuminate\Database\Seeder;

class ProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Proyectos::factory()->count(1)->create();
    }
}
