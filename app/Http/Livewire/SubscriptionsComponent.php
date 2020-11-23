<?php

namespace App\Http\Livewire;

use MercadoPago;
use Livewire\Component;
use App\Models\Servicios;
use MercadoPago\Customer;
use Illuminate\Http\Request;
use App\Models\CicloServicio;
use \Illuminate\Session\SessionManager;


class SubscriptionsComponent extends Component
{
    public $ciclo;
    

    //pago
    public $amount;
    public $token;

    protected $listeners = ['tokenMP' => 'tokenMP'];

    public function mount($slug,CicloServicio $ciclo, SessionManager $session)
    {
       

        $this->ciclo = $ciclo;
        $this->servicio = Servicios::where('slug',$slug)->first();

        $session->put("amount", $this->totalWithPorcent($this->ciclo->mes,$this->ciclo->porcentaje));
    }

    public function tokenMP($token) {

        $this->token = $token;
        $this->payment();
    }

    public function render()
    {
        $this->amount = $this->totalWithPorcent($this->ciclo->mes,$this->ciclo->porcentaje);

        return view('livewire.subscriptions-component',['ciclo' => $this->ciclo]);
    }

    public function payment()
    {
        MercadoPago\SDK::setAccessToken("TEST-2258135264899031-081803-62f513537c56b091e1d30705462c7cec-627662436"); // Either Production or SandBox AccessToken
        $payment = new  MercadoPago\Payment();
         //dd($this->token);
        $payment->transaction_amount = $this->amount;
        $payment->token =$this->token;
        $payment->description = "Prueba fran";
        $payment->installments = 1;
        $payment->payment_method_id = "visa";
        $payment->payer = array(
        "email" => $request->email
        );

         $payment->save();
         $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );

        $customer = new MercadoPago\Customer();
        $customer->email = $request->email;
        $customer->save();

        // $card = new MercadoPago\Card();
        // $card->token = $this->token;
        // $card->customer_id = $customer->id();
        // $card->save();
        return back()->withInput();
    }

    public function meses($mes)
    {
        $this->mes = $mes;

        $year = 12; //meses que es un año

        $operation = $this->mes / $year;

        if (is_float($operation)) {
            return $this->mes.' Mes(ses)';
        }else{
            return $operation.' Año(s)';
        }
    }

    public function totalWithPorcent($mes,$porcentaje)
    {
        $this->porcentaje = $porcentaje;
        $this->mes = $mes;
        
        $calculateTotal = $this->priceServiceWithPorcent($this->porcentaje) * $this->mes;

        return $calculateTotal;
    }

    
    public function priceServiceWithPorcent($porcentaje)
    {
        $this->porcentaje = $porcentaje;
        
        $porcentCalculate =   $this->ciclo->servicio->precio_normal * $this->porcentaje / 100;

        return $this->ciclo->servicio->precio_normal - $porcentCalculate; 
    }
}
