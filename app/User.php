<?php

namespace app;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'password', 'tipo', 'foto', 'nro_usuario', 'estado',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ["full_name"];

    public function getFullNameAttribute()
    {
        if ($this->tipo == 'CLIENTE') {
            return $this->cliente->nombre . ' ' . $this->cliente->paterno . ' ' . $this->cliente->materno;
        }
        return $this->datosUsuario->nombre . ' ' . $this->datosUsuario->paterno . ' ' . $this->datosUsuario->materno;
    }

    public function datosUsuario()
    {
        return $this->hasOne('app\DatosUsuario', 'user_id', 'id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'user_id');
    }

    public function ordens()
    {
        return $this->hasMany(Orden::class, 'distribuidor_id');
    }
}
