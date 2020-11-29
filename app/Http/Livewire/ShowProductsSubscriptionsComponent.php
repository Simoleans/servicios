<?php

namespace App\Http\Livewire;

use App\Models\Servicios;
use Livewire\Component;

class ShowProductsSubscriptionsComponent extends Component
{
    public $slug;
    public $search;

    public function mount($slug)
    {
        $this->servicio = Servicios::where('slug',$slug)->first();
    }
    public function render()
    {
        return view('livewire.show-products-subscriptions-component',['productos' => $this->servicio->productos()->paginate(5)])->layout('layouts.app',['header' => 'Tienda de '.$this->servicio->nombre]);
    }
}
