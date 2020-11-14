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

    public function getPorcentajeProperty()
    {
        return $this->porcentaje == '' ? 0 : $this->porcentaje;
    }

    public function mount(Servicios $servicio)
    {
        $this->servicio = $servicio;

    }

    public function productoHidden($producto_id,$porcentaje) {
        //dd($producto_id,$porcentaje);
        $this->productoID = $producto_id;
        $this->porcentaje = $porcentaje;
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
        //dd(request());
        $this->validate([
            'porcentaje' => 'integer|max:100',
        ]);
           // dd($this->porcentaje);
        ServicioProductos::create([
            'producto_id' => $this->productoID,
            'servicio_id' => $this->servicio->id,
            'porcentaje' => $this->porcentaje
        ]);

        $this->dispatchBrowserEvent('modal', ['modal' => false]);
        $this->reset(['porcentaje','productoID']);
    }

    public function deleteProductToService($id)
    {
        ServicioProductos::destroy($id);
    }

    
}
