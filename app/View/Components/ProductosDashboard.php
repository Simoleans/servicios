<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductosDashboard extends Component
{
    public $productos;
    public $servicios;

    public function __construct($productos,$servicios)
    {
        $this->productos = $productos;
        $this->servicios = $servicios;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.productos-dashboard',['productos' => $this->productos,'servicios' => $this->servicios]);
    }
}
