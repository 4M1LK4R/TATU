<?php

namespace TATU;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = [
        'nombre', 'estado', 'id_tipo_catalogo'
    ];

    public function tipo_catalogo()
    {
        return $this->belongsTo(TipoCatalogo::class);
    }
}
