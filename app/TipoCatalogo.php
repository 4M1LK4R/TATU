<?php

namespace TATU;

use Illuminate\Database\Eloquent\Model;

class TipoCatalogo extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'estado'
    ];

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class);
    }
}


