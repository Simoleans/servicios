<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PaymentMercadoPago extends Model
{
    const TOKEN = 'TEST-2258135264899031-112100-6dd8301e50db089345c52f4b09002ea7-627662436';

    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_type_id',
        'user_id',
        'customer_id',
        'status_pago_mp',
        'status'
    ];

    public function store($request)
    {
        dd($request->all());
    }
}
