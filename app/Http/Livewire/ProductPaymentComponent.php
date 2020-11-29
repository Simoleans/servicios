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

    public function mount($slug,$producto, SessionManager $session)
    {
        $this->producto = Producto::findOrfail($producto);
        $this->servicio = Servicios::where('slug',$slug)->first();
        $this->serviceProduct = ServicioProductos::where('servicio_id',$this->servicio->id)->where('producto_id',$producto)->first();
        //dd(porcentSubscriptionProduct($this->producto->precio_normal,$this->serviceProduct->porcentaje));
        $session->put("amount", porcentSubscriptionProduct($this->producto->precio_normal,$this->serviceProduct->porcentaje));
    }

    public function render()
    {
        //dd(session('amount'));
        return view('livewire.product-payment-component',['servicio' => $this->servicio]);
    }
}
