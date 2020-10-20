<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago;


class PagosController extends Controller
{
    public function payment_mercadopago(Request $request)
    {
    	 MercadoPago\SDK::setAccessToken("TEST-2258135264899031-081803-62f513537c56b091e1d30705462c7cec-627662436"); // Either Production or SandBox AccessToken

    $payment = new  MercadoPago\Payment();
    
    $payment->transaction_amount = 200000;
    $payment->token = $request->token;
    $payment->description = "Prueba fran";
    $payment->installments = 1;
    $payment->payment_method_id = "visa";
    $payment->payer = array(
      "email" => "larue.nienow@email.com"
    );

    $payment->save();
dd($payment->status);
   
    }
}
