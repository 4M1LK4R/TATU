<?php

namespace TATU;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    //
    protected $fillable = [
        'nombre','estado','id_tipo_establecimiento'
    ];
    public function tipo_establecimineto()
    {
        return $this->belongsTo(Catalogo::class);
    }
    public function detalles_users_establecimientos()
    {
        return $this->hasMany(DetalleUserEstablecimiento::class);
    }
}
