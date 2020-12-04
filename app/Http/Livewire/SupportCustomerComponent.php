<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\Support;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SupportCustomerComponent extends Component
{
    use WithFileUploads;

    public  $listeners = ['showMessages'];
    public $messages = [];
    public $support;
    public $supports;
    public $supportID;
    public $name = 'Crear Ticket';
    public $showForm = true;
    public $formTittle = true;
    public $closeButton = true;

    //store
    public $mensaje,$file,$tittle;

    public function mount()
    {
        $this->supports = Support::mySupport()->active()->orderBy('id','DESC')->get();
    }

    public function showMessages($support)
    {
        $this->supportID = $support;
        $this->support = Support::findOrfail($support);
        $this->messages = $this->support->messages;
        $this->name = $this->support->user->name;
        $this->formTittle = false;

    }
    
    public function render()
    {
        return view('livewire.support-customer-component',[
            'supports' => $this->supports,
        ])->layout('layouts.app',['header' => 'Contactar a Soporte']);
    }

    public function store()
    {
        // dd($this->file);
        if($this->mensaje == null)
        {
           return  $this->addError('mensaje', 'no puede dejar el mensaje vacío.');
        }

        if ($this->tittle != null) {
            $support = Support::create([
                'user_id' => auth()->user()->id,
                'tittle' => $this->tittle,
                // 'message' => $this->mensaje,
                // 'file' => $this->file != null ? $this->file->store('fotos/support/'.auth()->user()->email, 'public',$this->file->getClientOriginalName().'.'.$this->file->extension()) : NULL,
            ]);

            $support->messages()->create([
                                'user_id' => auth()->user()->id,
                                'message' => $this->mensaje,
                                'file' => $this->file != null ? $this->file->store('fotos/support/'.auth()->user()->email, 'public',$this->file->getClientOriginalName().'.'.$this->file->extension()) : NULL,
                            ]);
            $this->supportID = $support->id;

            // Message::create([
            //     'user_id' => auth()->user()->id,
            //     'supports_id' => $support->id,
            //     'message' => $this->mensaje,
            //     'file' => $this->file != null ? $this->file->store('fotos/support/'.auth()->user()->email, 'public',$this->file->getClientOriginalName().'.'.$this->file->extension()) : NULL,
            // ]);
        }else{
            Message::create([
                'user_id' => auth()->user()->id,
                'supports_id' => $this->supportID,
                'message' => $this->mensaje,
                'file' => $this->file != null ? $this->file->store('fotos/support/'.auth()->user()->email, 'public',$this->file->getClientOriginalName().'.'.$this->file->extension()) : NULL,
            ]);
        }

        $this->emit('showMessages',$this->supportID);
        $this->reset(['mensaje','file']);
    }

    public function newMessage()
    {
        $this->openMessage();
    }

    public function closeMessage()
    {
        $this->formTittle = true;
        $this->supportID = null;
        $this->messages = [];
        $this->supports = Support::mySupport()->inactive()->orderBy('id','DESC')->get();
        $this->showForm = false;
        $this->name = 'Mensajes Cerrados..';
        $this->closeButton = false;
    }

    public function openMessage()
    {
        $this->formTittle = true;
        $this->supportID = null;
        $this->messages = [];
        $this->supports = Support::mySupport()->active()->orderBy('id','DESC')->get();
        $this->showForm = true;
        $this->name = 'Crear Ticket..';
        $this->closeButton = true;
    }
}
