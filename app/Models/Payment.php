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
}
