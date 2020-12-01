<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicios;

class SaleServicioComponent extends Component
{
    public $servicio;
    public $search;
    public $mes;

    // Opreaciones
    public $porcentaje;

    //options renovar-comprar
    public $comprar = true;

    public function mount($slug)
    {
        $this->servicio = Servicios::where('slug',$slug)->first();
    }

    public function render()
    {
        return view('livewire.sale-servicio-component',[
                'servicio' => $this->servicio
        ])->layout('layouts.app',['header' => "Planes | {$this->servicio->nombre}"]);
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

        return number_format($calculateTotal ,2);
    }

    
    public function priceServiceWithPorcent($porcentaje)
    {
        $this->porcentaje = $porcentaje;
        
        $porcentCalculate =   $this->servicio->precio_normal * $this->porcentaje / 100;

        return $this->servicio->precio_normal - $porcentCalculate; 
    }

}
