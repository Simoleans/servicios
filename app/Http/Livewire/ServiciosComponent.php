<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicios;

class ServiciosComponent extends Component
{
    public function render()
    {
        return view('livewire.servicios-component',['servicios' => Servicios::where('nombre','LIKE',"%{$this->search}%")->paginate(15)])->layout('layouts.app',['header' => 'Servicios']);
    }
}
