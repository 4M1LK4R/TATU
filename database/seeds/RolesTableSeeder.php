<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TATU\Role::create([
            'nombre' => 'ADMINISTRADOR',
            'descripcion' => 'Administrador global del sistema.',
            'estado' => 'ACTIVO'
        ]);
        TATU\Role::create([
            'nombre' => 'MODERADOR',
            'descripcion' => 'Moderador de denuncias y administrador de entidades.',
            'estado' => 'ACTIVO'
        ]);
        TATU\Role::create([
            'nombre' => 'ESTANDAR',
            'descripcion' => 'Usuario normal turista ó ciudadano.',
            'estado' => 'ACTIVO'
        ]);

        /*
        TATU\Role::create([
            'nombre' => 'RECEPCIONISTA',
            'descripcion' => 'Usuario para registrar turistas en establecimientos.',
            'estado' => 'ACTIVO'
        ]);
        */

    }
}
