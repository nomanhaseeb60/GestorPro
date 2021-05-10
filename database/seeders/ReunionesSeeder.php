<?php

namespace Database\Seeders;

use App\Models\Reuniones;
use Illuminate\Database\Seeder;

class ReunionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Reuniones::factory()->count(1)->create();
    }
}
