<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'servicio_id',
        'ciclo_id',
        'producto_id',
        'monto',
        'ticket_id',
        'plataform_payment',
        'status'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAllSearchPayment($query,$search)
    {
        if ($search) {
            return $query->whereHas('servicio', function ($q) use ($search) {
                $q->where('nombre','LIKE',"%{$search}%");
            })->orWhereHas('producto', function ($q) use ($search) {
                $q->where('nombre','LIKE',"%{$search}%");
            })->orWhereHas('user', function ($q) use ($search) {
                $q->where('email','LIKE',"%{$search}%");
            });
        }
    }
}
