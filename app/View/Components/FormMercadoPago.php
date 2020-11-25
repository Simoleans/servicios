<?php

namespace App\View\Components;

use App\Models\CicloServicio;
use Illuminate\View\Component;

class FormMercadoPago extends Component
{
    public $ciclo;

    public function __construct($ciclo)
    {
        $this->ciclo = $ciclo;
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $servicio = CicloServicio::findOrfail($this->ciclo);
        
        return view('components.form-mercado-pago',['ciclo' => $this->ciclo,'servicio' => $servicio->servicio_id]);
    }
}
