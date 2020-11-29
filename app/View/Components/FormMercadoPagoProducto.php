<?php

namespace App\View\Components;

use App\Models\Producto;
use App\Models\ServicioProductos;
use Illuminate\View\Component;

class FormMercadoPagoProducto extends Component
{
    public $producto;

    public function __construct($producto)
    {
        $this->producto = Producto::findOrfail($producto);
        $this->amount = porcentSubscriptionProduct($this->producto->precio_normal);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-mercado-pago-producto',['producto' => $this->producto]);
    }
}
