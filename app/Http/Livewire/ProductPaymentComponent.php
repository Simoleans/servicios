<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\ServicioProductos;
use Livewire\Component;
use App\Models\Servicios;
use Illuminate\Session\SessionManager;

class ProductPaymentComponent extends Component
{
    public $ticketExists = false;
    public $servicio;
    public $serviceProduct = null;

    public function mount($slug = null,$producto, SessionManager $session)
    {
        $this->producto = Producto::findOrfail($producto);
        if ($slug != null) {
            $this->servicio = Servicios::where('slug',$slug)->first();
            $this->serviceProduct = ServicioProductos::where('servicio_id',$this->servicio->id)->where('producto_id',$producto)->first();

            $session->put("amount", porcentSubscriptionProduct($this->producto->precio_normal,$this->serviceProduct->porcentaje));
        }else{
            $session->put("amount", $this->producto->precio_normal);
        }
        
    }

    public function render()
    {
        //dd(session('amount'));
        return view('livewire.product-payment-component',['servicio' => $this->servicio]);
    }
}
