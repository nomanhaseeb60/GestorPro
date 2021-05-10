<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // crear roles
        $role1 = Role::create(['name' => 'programador']);
        $role2 = Role::create(['name' => 'administrador']);

        // crear dos usuario de demo en el sistema
        $user = \App\Models\User::factory()->create([
            'nombre' => 'juan',
            'email' => 'programmer@example.com',
            'apellidos' => 'pablo',
            'dni' => 'Y111239W',
            'fecha_nacimiento' => Carbon::create('1999','12','12'),
            'direccion' => 'null',
            'sueldo' => 1200.00,
            'telefono' => 'null',
            'ciudad' => 'null',
            'dept_id' => 1,
            'password' => Hash::make('programmer'),
            'id_jefe' => 1
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'nombre' => 'pablo',
            'email' => 'admin@example.com',
            'apellidos' => 'lorrente',
            'dni' => 'Y111239W',
            'fecha_nacimiento' => Carbon::create('1999','12','12'),
            'direccion' => 'null',
            'sueldo' => 1200.00,
            'telefono' => 'null',
            'ciudad' => 'null',
            'dept_id' => 1,
            'password' => Hash::make('admin'),
            'id_jefe' => 1
        ]);
        $permission = Permission::create(['name' => 'menu']);
        $user->givePermissionTo($permission);
        $permission->assignRole($role2);
        $user->assignRole($role2);
    }
}
