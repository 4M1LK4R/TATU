<?php

namespace TATU;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'nombre', 'descripcion','estado'
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
