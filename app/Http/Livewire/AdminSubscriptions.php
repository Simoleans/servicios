<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriptions;
use Carbon\Carbon;

class AdminSubscriptions extends Component
{
    public $search,$subscription_id;
    public $modalConfirmBaja = false;
    public $modalExtender = false;
    public $modalRestar = false;

    public $cantidad;

    public function render()
    {
        Carbon::setLocale('es');
        return view('livewire.admin-subscriptions',[
            'subscriptions' => Subscriptions::whereHas('user', function ($query){
                $query->where('email','LIKE',"%{$this->search}%")->orWhere('name','LIKE',"%{$this->search}%")->orderby('id','DESC');
            })->where('status',1)->paginate(5)
        ])->layout('layouts.app',['header' => 'Todas las subscripciones Activas']);
    }

    public function confirmBaja($id)
    {
        $this->subscription_id = $id;
        $this->openModal();
    }

    public function confirmExtender($id)
    {
        $this->subscription_id = $id;
        $this->openModalExtender();
    }

    public function confirmRestar($id)
    {
        $this->subscription_id = $id;
        $this->openModalRestar();
    }

    public function extenderSubscription()
    {
        $this->validate([
            'cantidad' => 'required|integer|max:36',
        ]);

        $subscription = Subscriptions::findOrfail($this->subscription_id);

        $subscription->update([
            'end_date' => $subscription->end_date->addMonths($this->cantidad)
        ]);

        session()->flash('message', 
        'Has dado de baja a esté servicio correctamente.');

        $this->closeModalExtender();
        $this->subscription_id = '';

    }

    public function restarSubscription()
    {
        $this->validate([
            'cantidad' => 'required|integer|max:36',
        ]);

        $subscription = Subscriptions::findOrfail($this->subscription_id);

        if ($subscription->end_date->subMonths($this->cantidad)->lessThanOrEqualTo(Carbon::now())) {
           return $this->addError('cantidad', 'No puede quedar con una fecha menor a la de hoy.');
        }

        $subscription->update([
            'end_date' => $subscription->end_date->subMonths($this->cantidad)
        ]);

        session()->flash('message', 
        'Has restado '.$this->cantidad.' meses a esta subscripción.');

        $this->closeModalRestar();
        $this->subscription_id = '';

    }

    public function darseBaja()
    {
        $subscription = Subscriptions::findOrfail($this->subscription_id)->update([
            'status' => 0,
            'end_date' => date('Y-m-d')
        ]);

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

    public function openModalExtender()
    {
        $this->modalExtender = true;
    }

    public function closeModalExtender()
    {
        $this->modalExtender = false;
        $this->cantidad= '';
    }

    public function openModalRestar()
    {
        $this->modalRestar = true;
    }

    public function closeModalRestar()
    {
        $this->modalRestar = false;
        $this->cantidad= '';
    }
}
