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
        'porcentaje',
    ];

    public function setPorcentajeAttribute($value)
    {
        $this->attributes['porcentaje'] = $value === '' ? 0 : $value;
    }

    function descuento()
    {
        if($this->porcentaje > 0 && $this->porcentaje < 100)
        {
            return '-'.$this->porcentaje.'%';

        }else if($this->porcentaje == 0 ){
            return 'TOTAL';
        }elseif($this->porcentaje == 100){
            return 'GRATIS';
        }
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class,);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class,);
    }
}
