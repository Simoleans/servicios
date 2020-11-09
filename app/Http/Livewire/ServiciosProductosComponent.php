<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Servicios;
use App\Models\ServicioProductos;

class ServiciosProductosComponent extends Component
{

    public $servicio,$search;

    public function mount(Servicios $servicio)
    {
        $this->servicio = $servicio;

    }

    public function render()
    {
        return view('livewire.servicios-productos-component',[
                'servicio' => $this->servicio,
                'productos' => Producto::whereDoesntHave('servicios', function ($query) {
                    $query->where('nombre','LIKE',"%{$this->search}%");
               })->paginate(4),
               'serviciosProductos' => $this->servicio->productos()->paginate(5)])
            ->layout('layouts.app',['header' => "{$this->servicio->nombre}"]);
    }

    public function addProductToService($id)
    {
        ServicioProductos::create([
            'producto_id' => $id,
            'servicio_id' => $this->servicio->id,
        ]);
    }

    public function deleteProductToService($id)
    {
        ServicioProductos::destroy($id);
    }
}
