<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $fillable = [
        'nombre', 'descripcion',
    ];

    public function usuario()
    {
        return $this->hasMany(DatosUsuario::class, 'distribuidor_id');
    }
}
