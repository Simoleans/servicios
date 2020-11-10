<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class TicketComponent extends Component
{

    public $search;
    public $codigo,$fecha_exp,$tipo,$monto;
    public $isOpen = true;
    public $inputFoto = true;

    public function render()
    {
        return view('livewire.ticket-component',['tickets' => Ticket::all()])->layout('layouts.app',['header' => 'Ticket de descuentos']);
    }

    public function store()
    {
        $this->validate([
            'codigo' => 'required|unique:tickets',
            'fecha_exp' => 'date',
            'tipo' => 'required',
            'monto' => 'required|min:2|max:7',
        ]);
        
        dd("store");
    }
}
