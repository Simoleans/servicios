<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicios;
use Livewire\WithFileUploads;

class ServiciosComponent extends Component
{

    use WithFileUploads;

    public $search, $nombre, $descripcion_corta,$foto,$descripcion_larga,$precio_rebajado,$precio_normal,$dias_pruebas,$dias_suspender,$dias_notificar,$ciclo_facturacion;
    public $isOpen = true;
    public $inputFoto = true;
    
    public function render()
    {
        return view('livewire.servicios-component',['servicios' => Servicios::where('nombre','LIKE',"%{$this->search}%")->orWhere('descripcion_larga','LIKE',"%{$this->search}%")->paginate(6)])->layout('layouts.app',['header' => 'Servicios']);
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|unique:productos',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'foto' => 'required|file|max:13000|mimes:png,jpeg',
            'precio_rebajado' => 'required|max:8|min:2',
            'precio_normal' => 'required|max:8|min:2',
            'dias_pruebas' => 'required',
            'dias_suspender' => 'required',
            'dias_notificar' => 'required',
            'ciclo_facturacion' => 'required',
        ]);
          
        Servicios::create([
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            'foto' => $this->foto->store('fotos/servicios', 'public',Servicios::slugify($this->nombre).'.'.$this->foto->extension()),
            'precio_rebajado' => $this->precio_rebajado,
            'precio_normal' => $this->precio_normal,
            'dias_pruebas' => $this->dias_pruebas,
            'dias_suspender' => $this->dias_suspender,
            'dias_notificar' => $this->dias_notificar,
            'ciclo_facturacion' => $this->ciclo_facturacion
        ]);
  
        session()->flash('message', 
            'Servicio Creado Correctamente.');
  
        //$this->closeModal();
        $this->reset([
            'nombre',
            'descripcion_corta',
            'descripcion_larga',
            'foto',
            'precio_rebajado',
            'precio_normal',
            'dias_pruebas',
            'dias_suspender',
            'dias_notificar',
            'ciclo_facturacion',
        ]);

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
