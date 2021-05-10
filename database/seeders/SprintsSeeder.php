<?php

namespace Database\Seeders;

use App\Models\Sprints;
use Illuminate\Database\Seeder;

class SprintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sprints::factory()->count(1)->create();
    }
}
