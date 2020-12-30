<?php

namespace App\Http\Livewire;

use App\Models\Subscriptions;
use Livewire\Component;

class SubscriptionUserComponent extends Component
{
    public $search,$subscription_id;

    public $modalConfirmBaja = false;

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

    public function confirmBaja($id)
    {
        $this->subscription_id = $id;
        $this->openModal();
    }

    public function darseBaja()
    {
        $subscription = Subscriptions::findOrfail($this->subscription_id)->update([
            'status' => 0,
            'end_date' => date('Y-m-d')
        ]);
        // $subscription->status = 0;
        // $subscription->end_date = date('Y-m-d');

        session()->flash('message', 
        'Te has dado de baja correctamente, esperamos que vuelvas pronto.');

        $this->closeModal();
        $this->subscription_id = '';

    }

    public function openModal()
    {
        $this->modalConfirmBaja = true;
    }

    public function closeModal()
    {
        $this->modalConfirmBaja = false;
    }
}
