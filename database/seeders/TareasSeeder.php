<?php

namespace Database\Seeders;

use App\Models\Tareas;
use Illuminate\Database\Seeder;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tareas::factory()->count(1)->create();
    }
}
