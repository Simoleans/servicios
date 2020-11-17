<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiciosDashboard extends Component
{
    public $servicios;
    public $productos;

    public function __construct($servicios,$productos)
    {
        $this->servicios = $servicios;
        $this->productos = $productos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.servicios-dashboard',['servicios' => $this->servicios,'productos' => $this->productos]);
    }
}
