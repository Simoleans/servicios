<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class PaymentsUserComponent extends Component
{
    public $search;
    
    use WithPagination;

    public function render()
    {
        return view('livewire.payments-user-component',['pagos' => auth()->user()->payments()->allSearch($this->search)->paginate(5)])->layout('layouts.app',['header' => 'Mis Pagos']);
    }
}
