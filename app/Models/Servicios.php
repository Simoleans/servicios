<?php

namespace App\Models;

use App\Models\ServicioProductos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion_corta',
        'descripcion_larga',
        'foto',
        'precio_rebajado',
        'precio_normal',
        'dias_pruebas',
        'dias_suspender',
        'dias_notificar',
        'status'
    ];

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function productos()
    {
        return $this->hasMany(ServicioProductos::class,'servicio_id');
    }

    public function ciclos()
    {
        return $this->hasMany(CicloServicio::class,'servicio_id');
    }
}
