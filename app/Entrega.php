<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = [
        'cliente_id', 'orden_id', 'qr', 'valoracion',
        'fecha_entrega', 'hora_entrega', 'fecha_hora_entrega',
        'estado', 'fecha_registro', 'status'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'entrega_id');
    }
}
