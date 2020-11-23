<?php

namespace App\Models;

use MercadoPago;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerMercadoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
    ];


    public static function store($email)
    {
        $customer = new MercadoPago\Customer();
        $customer->email = $email;
        $customer->first_name = auth()->user()->name;
        $customer->save();

        $response = Http::withToken(PaymentMercadoPago::TOKEN)->get('https://api.mercadopago.com/v1/customers/search?email='.$email);
        $id = $response->json()['results']['0']['id'];

        $customer_system = CustomerMercadoPago::firstOrCreate([
          'user_id' => auth()->user()->id,
          'customer_id' => $id
        ]);
    }
}
