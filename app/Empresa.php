<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function usuario()
    {
        return $this->hasMany(DatosUsuario::class, 'empresa_id');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'empresa_id');
    }

    public function ordens()
    {
        return $this->hasMany(Orden::class, 'empresa_id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'empresa_id');
    }
}
