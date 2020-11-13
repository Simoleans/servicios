<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Servicios;
use App\Models\ServicioProductos;

class ServiciosProductosComponent extends Component
{

    public $servicio,$productoID,$porcentaje,$search;
    public $isOpen = false;

    protected $listeners = ['productoHidden'];

    public function mount(Servicios $servicio)
    {
        $this->servicio = $servicio;

    }

    public function productoHidden($array) {
        $this->productoID = $array;
        $this->addProductToService();
    }

    public function render()
    {
        return view('livewire.servicios-productos-component',[
                'servicio' => $this->servicio,
                'productos' => Producto::whereDoesntHave('servicios', function ($query) {
                    $query->where('servicio_id',$this->servicio->id);
               })->where('nombre','LIKE',"%{$this->search}%")->paginate(4),
               'serviciosProductos' => $this->servicio->productos()->orderby('id','DESC')->paginate(5)])
            ->layout('layouts.app',['header' => "{$this->servicio->nombre}"]);
    }

    public function addProductToService()
    {
        $this->validate([
            'porcentaje' => 'required|max:100|min:0',
        ]);

        ServicioProductos::create([
            'producto_id' => $this->productoID,
            'servicio_id' => $this->servicio->id,
        ]);

        $this->dispatchBrowserEvent('modal', ['modal' => false]);
        $this->reset(['porcentaje','productoID']);
    }

    public function deleteProductToService($id)
    {
        ServicioProductos::destroy($id);
    }

    
}
