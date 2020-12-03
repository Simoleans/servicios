<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class PagosAdminComponent extends Component
{
    public $search;

    use WithPagination;


    public function render()
    {
        return view('livewire.pagos-admin-component',['pagos' => Payment::allSearchPayment($this->search)->paginate(5)])->layout('layouts.app',['header' => 'Pagos']);
    }
}
