<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SubscriptionUserComponent extends Component
{
    public $search;

    public function mount()
    {
        auth()->user()->serviceExpiredQuery()->update([
            'status' => 0
        ]);
    }
    
    public function render()
    {
        return view('livewire.subscription-user-component',[
            'subscriptions' => auth()->user()->subscriptions()->active()->whereHas('servicio', function ($query){
                $query->where('nombre','LIKE',"%{$this->search}%")->orWhere('descripcion_larga','LIKE',"%{$this->search}%")->orderby('id','DESC');
            })->paginate(5)
        ])->layout('layouts.app',['header' => 'Mis Subscripciones']);
    }
}
