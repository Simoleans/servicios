<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicios;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 


class ServiciosComponent extends Component
{

    use WithFileUploads;

    public $search, $nombre, $descripcion_corta,$foto,$descripcion_larga,$precio_rebajado,$precio_normal,$dias_pruebas,$dias_suspender,$dias_notificar,$ciclo_facturacion;
    //dynamic inputs ciclo de meses
    public $isOpen = true;
    public $inputFoto = true;
    public $serv;

    //input dynamic
    public $counter = 0;
    public $arrayFormCiclo = []; 

    
    public function render()
    {
        return view('livewire.servicios-component',['servicios' => Servicios::where('nombre','LIKE',"%{$this->search}%")->orWhere('descripcion_larga','LIKE',"%{$this->search}%")->paginate(6)])
               ->layout('layouts.app',['header' => 'Servicios']);
    }

    public function store()
    {
        //dd($this->mes);
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
            'serv.*.mes' => 'integer|required|max:36',
            'serv.*.oferta' => 'integer|required|max:100',
            'serv' => 'required|array|max:4'
        ],
        [
            'serv.*.mes.required' => 'El mes no puede quedar vacio.',
            'serv.*.oferta.required' => 'La oferta no puede quedar vacia.',
            'serv.*.mes.max' => 'El mes no puede pasar de 36.',
            'serv.*.oferta.max' => 'La oferta no puede pasar del 100%.',
            'serv.required' => 'Debe agregar al menos 1 ciclo de pago.',
            'serv.max' => 'Solo se permiten 4 ciclos de pago.'
        ]);
        //$this->validate();
        dd($this->serv);

        dd("hola");

       
          
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

        
    /**
     * crear input dinamicos, llenando el array 
     *
     * @return array
     */
    public function addInputCicloServicio()
    {
        $i = $this->counter + 1;
        $this->counter = $i;
        array_push($this->arrayFormCiclo, $i);
    }
    
    /**
     * Borrar los input dinamicos de ciclos mensuales
     *
     * @param  int $key
     * @return array
     */
    public function deleteInputCicloServicio($key)
    {
        unset($this->arrayFormCiclo[$key]);
    }

    public function storeCiclo()
    {
        $this->validate([
            'mes.*' => 'required|max:36|min:1',
            'oferta.*' => 'required|max:100|min:1',
        ]);

        dd($this->mes,$this->oferta);
    }
}
