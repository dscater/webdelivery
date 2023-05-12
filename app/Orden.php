<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'nro_orden', 'empresa_id', 'producto_id', 'cantidad',
        'cliente_id', 'distribuidor_id', 'fecha_pedido', 'hora_pedido',
        'fecha_hora_pedido', 'fecha_entrega', 'hora_entrega',
        'fecha_hora_entrega', 'estado', 'fecha_registro', 'status'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function distribuidor()
    {
        return $this->belongsTo(User::class, 'distribuidor_id');
    }

    public function entrega()
    {
        return $this->hasOne(Entrega::class, 'orden_id');
    }
}
