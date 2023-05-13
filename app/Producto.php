<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'empresa_id', 'nombre', 'descripcion', 'precio', 'foto',
        'fecha_registro', 'estado',
    ];

    protected $appends = ["url_imagen"];

    public function getUrlImagenAttribute()
    {
        if ($this->foto) {
            return asset("imgs/productos/" . $this->foto);
        }
        return asset("imgs/productos/default.png");
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
