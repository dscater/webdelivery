<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
    protected $fillable = [
        'nombre', 'alias', 'ciudad', 'dir',
        'correo', 'nit', 'nro_aut', 'fono',
        'cel', 'casilla', 'web', 'logo', 'actividad_economica',
    ];
}
