<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'empresa_id', 'nombre', 'descripcion', 'precio',
        'fecha_registro', 'estado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
