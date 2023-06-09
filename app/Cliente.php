<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci',
        'ci_exp', 'dir', 'email', 'fono', 'cel',
        'user_id', 'fecha_registro',
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

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'cliente_id');
    }
}
