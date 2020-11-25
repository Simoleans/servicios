<?php

namespace App\Http\Controllers;

use App\Models\CustomerMercadoPago;
use App\Models\PaymentMercadoPago;
use App\Models\Pagos\Pagos;
use MercadoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PagosController extends Controller
{
  public $customerMP;
  public $paymentMP;

  function __construct() 
  {
    $this->customerMP = new CustomerMercadoPago();  
    $this->paymentMP = new PaymentMercadoPago();  
  }

  public function payment_mercadopago_index($slug,$ciclo)
  {
    return view('servicios.payment',['slug' => $slug,'ciclo' => $ciclo]);
  }
    public function payment_mercadopago(Request $request)
    {

       MercadoPago\SDK::setAccessToken(PaymentMercadoPago::TOKEN); // Either Production or SandBox AccessToken
       
      //customer va primero, el pago va asociado al customer (validando que si existe no lo hguarde)
      $this->customerMP->store($request->email);

      //save paymentMP
      $payment = $this->paymentMP->store($request);


      //store para el sistema
      // $customer_system = CustomerMercadoPago::create([
      //   'user_id' => auth()user()->id,
      //   'customer_id' => 
      // ])

     // dd($payment->status,$payment->status_detail);

        if ($payment->status != 'approved') {
          return redirect()->back()->with('message', $this->paymentMP->message($payment->status_detail));
        }else{
          return redirect()->route('dashboard')->with('message', 'Su pago ha sido procesado.');
        }


//         $resp = Http::withHeaders([
//             'Authorization' => 'Bearer TEST-2258135264899031-112100-6dd8301e50db089345c52f4b09002ea7-627662436',
//           // 'X-otra-cabecera' => 'valor-2'
//         ])->get('https://api.mercadopago.com/v1/payments/'.$payment->id);

//       // $cust = Http::withHeaders([
//       //     'Authorization' => 'Bearer TEST-2258135264899031-112100-6dd8301e50db089345c52f4b09002ea7-627662436',
//       //   // 'X-otra-cabecera' => 'valor-2'
//       // ])->get('https://api.mercadopago.com/v1/customers/search?email='.$request->email);
// //
//       dd($payment,$customer,$resp->json(),(object) $cust->json(),$request->all());

   
    }
}
