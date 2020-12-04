<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\Support;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; 

class AdminSupportComponent extends Component
{
    use WithFileUploads;

    public  $listeners = ['showMessages'];
    public $messages = [];
    public $support;
    public $supports;
    public $supportID;
    public $name = 'Mensajes...';
    public $showForm = false;
    public $closeButton = true;

    //store
    public $mensaje,$file;

    public function mount()
    {
        $this->supports = Support::active()->orderBy('id','DESC')->get();
    }

    public function showMessages($support)
    {
        $this->supportID = $support;
        $this->support = Support::findOrfail($support);
        $this->messages = $this->support->messages;
        $this->name = $this->support->user->name;
        $this->showForm = true;

    }

    public function render()
    {
        return view('livewire.admin-support-component',[
                'supports' => $this->supports,
                'messages' => $this->messages
        ])->layout('layouts.app',['header' => 'Soporte Técnico']);
    }

    public function store()
    {
        if($this->mensaje == null)
        {
           return  $this->addError('mensaje', 'no puede dejar el mensaje vacío.');
        }

        $message = Message::create([
            'user_id' => auth()->user()->id,
            'supports_id' => $this->supportID,
            'message' => $this->mensaje,
            'file' => $this->file != null ? $this->file->store('fotos/support/'.auth()->user()->email, 'public',$this->file->getClientOriginalName().'.'.$this->file->extension()) : NULL,
        ]);

        $message->support()->update([
            'status' => 1
        ]);
        $this->emit('showMessages',$this->supportID);
        $this->reset(['mensaje','file']);
    }

    public function archiveSupport()
    {
        Support::findOrfail($this->supportID)->update([
            'status' => 0
        ]);

        
        $this->support = Support::active()->get();
        $this->supportID = null;
        $this->name = "Cerrado...";
        $this->showForm = false;

        session()->flash('message', 
            'Has cerrado este ticket de soporte.');
    }

    public function closeMessage()
    {
        $this->formTittle = true;
        $this->supportID = null;
        $this->messages = [];
        $this->supports = Support::inactive()->orderBy('id','DESC')->get();
        $this->showForm = false;
        $this->name = 'Mensajes Cerrados..';
        $this->closeButton = false;
    }

    public function openMessage()
    {
        $this->formTittle = true;
        $this->supportID = null;
        $this->messages = [];
        $this->supports = Support::active()->orderBy('id','DESC')->get();
        $this->showForm = false;
        $this->name = 'Ver Mensajes...';
        $this->closeButton = true;
    }
}
