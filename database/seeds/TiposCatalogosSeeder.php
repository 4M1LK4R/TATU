<?php

use Illuminate\Database\Seeder;

class TiposCatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TATU\TipoCatalogo::create([
        	'nombre' => 'TIPO ESTABLECIMIENTO',
        	'descripcion'=> 'Tipos de establecimientos para turistas.',
            'estado' => 'ACTIVO'
        ]);
        TATU\TipoCatalogo::create([
        	'nombre' => 'PAIS',
        	'descripcion'=> 'Paises de procedencia de los turistas.',
            'estado' => 'ACTIVO'
        ]);
        TATU\TipoCatalogo::create([
        	'nombre' => 'TIPO DOCUMENTO',
        	'descripcion'=> 'Tipos de documentos de los turistas.',
            'estado' => 'ACTIVO'
        ]);
        TATU\TipoCatalogo::create([
        	'nombre' => 'PROFESION',
        	'descripcion'=> 'Profesiones relacionadas con los turistas.',
            'estado' => 'ACTIVO'
        ]);
        TATU\TipoCatalogo::create([
        	'nombre' => 'NACIONALIDAD',
        	'descripcion'=> 'Nacionalidades relacionadas con los turistas.',
            'estado' => 'ACTIVO'
        ]);

    }
}
