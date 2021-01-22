<?php

namespace App\Http\Controllers;

use App\Models\CustomerMercadoPago;
use App\Models\PaymentMercadoPago;
use App\Models\Pagos\Pagos;
use App\Models\ProductoUser;
use App\Models\Subscriptions;
use MercadoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagosController extends Controller
{
  public $customerMP;
  public $paymentMP;
  public $subscription;

  function __construct() 
  {
    $this->customerMP = new CustomerMercadoPago();  
    $this->paymentMP = new PaymentMercadoPago();  
    $this->subscription = new Subscriptions();
  }

  public function payment_mercadopago_index($slug,$ciclo)
  {
    return view('servicios.payment',['slug' => $slug,'ciclo' => $ciclo,'renovated' => false]);
  }

  public function payment_renovar_mercadopago_index($slug,$ciclo)
  {
    return view('servicios.payment',['slug' => $slug,'ciclo' => $ciclo,'renovated' => true]);
  }
    public function payment_mercadopago(Request $request)
    {
      if($request->producto_id != null)
      {
         $existsProduct = ProductoUser::where('user_id',auth()->user()->id)->where('producto_id',$request->producto_id)->exists();
         if ($existsProduct) {
            return redirect()->route('my-subscriptions')->with('message', 'Ya has comprado esté producto.');
         }
        
      }

      MercadoPago\SDK::setAccessToken(PaymentMercadoPago::TOKEN); // Either Production or SandBox AccessToken
       
      //customer va primero, el pago va asociado al customer (validando que si existe no lo hguarde)
      $this->customerMP->store($request->email);

      //save paymentMP
      if(session("amount") < 1)
      {
        $this->paymentMP->store_free($request);

        return redirect()->route('my-subscriptions')->with('message', 'Su pago ha sido procesado.');
        
      }else{
        $payment =  $this->paymentMP->store($request);
         
         if ($payment->status != 'approved') {
          return redirect()->back()->with('message', $this->paymentMP->message($payment->status_detail));
        }else{
          if ($request->producto_id != null) {
            return redirect()->route('my-products')->with('message', 'Su pago ha sido procesado.');
          }else{
            return redirect()->route('my-subscriptions')->with('message', 'Su pago ha sido procesado.');
          }
        }
      }
      //$this->subscription->store();
      //store para el sistema
      // $customer_system = CustomerMercadoPago::create([
      //   'user_id' => auth()user()->id,
      //   'customer_id' => 
      // ])
        

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
