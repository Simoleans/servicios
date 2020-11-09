<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'servicio_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class,);
    }
}
