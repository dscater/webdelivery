<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $fillable = [
        "orden_id",
        "producto_id",
        "precio",
        "cantidad",
        "subtotal",
    ];
    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
