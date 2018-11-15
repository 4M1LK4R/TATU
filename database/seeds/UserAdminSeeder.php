<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = TATU\Role::where('nombre', 'ADMINISTRADOR')->first();

        TATU\User::create([
        	'name' => 'admin',
        	'email'=> 'admin@admin.com',
            'password' => bcrypt('admin'),
            'photo'=> null,
            'estado' => 'ACTIVO',
            'id_role' => $role->id
        ]);

    }
}
