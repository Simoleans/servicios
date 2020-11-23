<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MercadoPago;

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
        $payment = new  MercadoPago\Payment();
        $payment->transaction_amount = $request->transactionAmount;
        $payment->token = $request->token;
        $payment->description = $request->description;
        $payment->installments = 1;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->payer = array(
          "email" => $request->email
        );
        $payment->save();

        //dd($payment,$payment->id);

        self::create([
            'payment_id' => $payment->id,
            'payment_type_id' => $payment->payment_type_id,
            'user_id' => auth()->user()->id,
            'customer_id' => auth()->user()->customer->id,
            'status_pago_mp' => $payment->status,
        ]);
    }
}
