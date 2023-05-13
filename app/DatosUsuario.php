<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model
{
    protected $table = 'datos_usuarios';
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci',
        'ci_exp', 'dir', 'email', 'fono',
        'cel', 'fono_referencia', 'empresa_id', 'distribuidor_id', 'user_id',
        'fecha_registro',
    ];

    protected $appends = ["full_name"];

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->paterno . ' ' . $this->materno;
    }

    public function user()
    {
        return $this->belongsTo('app\User', 'user_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class, 'distribuidor_id');
    }
}
