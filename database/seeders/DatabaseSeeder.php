<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Clientes;
use Illuminate\Database\Seeder;

class   DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriasSeeder::class,
            ClientesSeeder::class,
            DepartamentosSeeder::class,
            RoleSeeder::class,
            ProyectosSeeder::class,
            SprintsSeeder::class,
            ReunionesSeeder::class,
            TareasSeeder::class
        ]);
    }
}
