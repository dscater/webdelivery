<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'entrega_id', 'metodo_pago', 'fecha_pago',
        'hora_pago', 'fecha_hora_pago', 'total_pago',
        'fecha_registro',
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class, 'entrega_id');
    }
}
