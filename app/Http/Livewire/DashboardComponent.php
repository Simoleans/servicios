<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Servicios;
use Livewire\WithPagination;

class DashboardComponent extends Component
{
    //use WithPagination;
    public $searchProducto;
    public $search;
    

    //propiedad [mes] para formatear mes del ciclo
    public $mes;

    public function render()
    {
        return view('livewire.dashboard-component',[
            'servicios' => Servicios::where('nombre','LIKE',"%{$this->search}%")->orWhere('descripcion_larga','LIKE',"%{$this->search}%")->orderby('id','DESC')->paginate(4,['*'], 'servicios'),
            'productos' => Producto::where('nombre','LIKE',"%{$this->searchProducto}%")->orWhere('descripcion_larga','LIKE',"%{$this->searchProducto}%")->orderby('id','DESC')->paginate(6,['*'],'productos')
        ])->layout('layouts.app',['header' => 'Dashboard']);
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

}
