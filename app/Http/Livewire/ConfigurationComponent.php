<?php

namespace App\Http\Livewire;

use App\Models\Configuration;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConfigurationComponent extends Component
{
    use WithFileUploads;
    public $configuration;
    public $logo;
    public $nombre;
    public $favicon;
    

    public function mount()
    {
        $this->configuration = Configuration::latest()->first();
        $this->nombre = Configuration::latest()->first() != null ? $this->configuration->nombre : 'Aplicación';
    }

    public function render()
    {
        return view('livewire.configuration-component')->layout('layouts.app',['header' => 'Configuración']);
    }

    public function store()
    {
        //dd($this->favicon->extension());
        $this->validate([
             //'logo' => 'image|max:3024', 
            // 'favicon' => 'required|image|max:3024', 
            'nombre' => 'required', 
        ]);
        //dd($this->favicon->extension());
        if ($this->favicon != null) {
            if($this->favicon->extension() != 'ico')
            {
                return $this->addError('favicon', 'El archivo para FAVICON debe ser con extensión .ico');
                

            }
        }

        if($this->configuration == null)
        {
            Configuration::create(
                [
                    'nombre' => $this->nombre,
                    'logo' => $this->logo != null ? $this->logo->store('img/config/logo', 'public',$this->logo->getClientOriginalName().'.'.$this->logo->extension()) : NULL,
                    'favicon' => $this->favicon != null ? $this->favicon->store('img/config/favicon', 'public',$this->favicon->getClientOriginalName().'.'.$this->favicon->extension()) : NULL,
                ]
            );
        }else{
            Configuration::findOrfail($this->configuration->id)->update(
                [
                    'nombre' => $this->nombre,
                    'logo' => $this->logo != null ? $this->logo->store('img/config/logo', 'public',$this->logo->getClientOriginalName().'.'.$this->logo->extension()) : $this->configuration->logo,
                    'favicon' => $this->favicon != null ? $this->favicon->store('img/config/favicon', 'public',$this->favicon->getClientOriginalName().'.'.$this->favicon->extension()) : $this->configuration->favicon,
                ]
            );
        }
        
        session()->flash('message', 'Se guardo la configuración exitosamente.');

         return redirect()->to('/admin-config');
       
    }
}
