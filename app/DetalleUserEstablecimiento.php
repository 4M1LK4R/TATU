<?php

namespace TATU;

use Illuminate\Database\Eloquent\Model;

class DetalleUserEstablecimiento extends Model
{
    //
    protected $fillable = [
        'id_user','id_establecimiento'
    ];
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

