<?php

namespace App\Http\Livewire;

use App\Models\ProductoUser;
use Livewire\Component;

class ProductosCompradosComponent extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.productos-comprados-component',['productos' => ProductoUser::where('user_id',auth()->user()->id)->where('status',1)->paginate(6)])->layout('layouts.app',['header' => 'Mis Productos']);
    }
}
