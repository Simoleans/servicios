<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subscriptions;

class AdminSubscriptions extends Component
{
    public $search,$subscription_id;
    public $modalConfirmBaja = false;
    public $modalExtender = false;
    public $modalRestar = false;
    public $modalConfirmEditar;
    public $fecha_start,$fecha_end;

    public $cantidad;

    use WithPagination;
    
    public function render()
    {
        Carbon::setLocale('es');
        return view('livewire.admin-subscriptions',[
            'subscriptions' => Subscriptions::SearchSubscription($this->search)->paginate(5)
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

    public function confirmEditar($id)
    {
        $subscription = Subscriptions::findOrfail($id);

        $this->subscription_id = $id;
        $this->fecha_start = $subscription->start_date->format('Y-m-d');
        $this->fecha_end = $subscription->end_date->format('Y-m-d');
        $this->modalConfirmEditar = true;
    }

    public function CloseConfirmEditar()
    {
        $this->fecha_start = '';
        $this->fecha_end = '';

        $this->subscription_id = '';
        $this->modalConfirmEditar = false;
        $this->resetValidation('fecha_start');
    }

    public function editarFechasSubscription()
    {
        $validatedData = $this->validate([
            'fecha_start' => 'required',
            'fecha_end' => 'required',
        ]);

        if ($this->fecha_start > $this->fecha_end) {
            return $this->addError('fecha_start', 'La fecha de incio no puede ser mayor a la fecha final.');
        }

        $subscription = Subscriptions::findOrfail($this->subscription_id)->update([
            'start_date' => $this->fecha_start,
            'end_date' => $this->fecha_end
        ]);

        session()->flash('message',
        'Has cambiado la fecha correctamente.');

        $this->CloseConfirmEditar();
    }

    
}
