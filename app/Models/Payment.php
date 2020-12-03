<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'servicio_id',
        'ciclo_id',
        'producto_id',
        'monto',
        'ticket_id'
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicios::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class)->withDefault(['codigo' => 'N/T']);
    }

    public function scopeAllSearch($query,$search)
    {
        if ($search) {
            return $query->whereHas('servicio', function ($q) use ($search) {
                $q->where('nombre','LIKE',"%{$search}%");
            })->orWhereHas('producto', function ($q) use ($search) {
                $q->where('nombre','LIKE',"%{$search}%");
            });
        }
    }
}
