<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto as ModelsProducto;

class Producto extends Component
{
    use WithFileUploads;

    public $search, $nombre, $descripcion_corta,$foto,$descripcion_larga,$precio_rebajado,$precio_normal;
    public $isOpen = 0;
    public $inputFoto = true;

    public function render()
    {
        //$this->productos = ModelsProducto::paginate(10);

        return view('livewire.producto',['productos' => ModelsProducto::where('nombre','LIKE',"%{$this->search}%")->paginate(15)]);
    }

    public function create()
    {
        $this->modalInputFile(true);
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|unique:productos',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'foto' => 'required|file|max:13000|mimes:png,jpeg',
            'precio_rebajado' => 'required',
            'precio_normal' => 'required',
        ]);
          
        ModelsProducto::create([
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            'foto' => $this->foto->store('fotos/productos', 'public',ModelsProducto::slugify($this->nombre).'.'.$this->foto->extension()),
            'precio_rebajado' => $this->precio_rebajado,
            'precio_normal' => $this->precio_normal
        ]);
  
        // session()->flash('message', 
        //     $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
        session()->flash('message', 
            'Producto Creado Correctamente.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    private function resetInputFields(){

      $this->nombre = '';

      $this->descripcion_corta = '';

      $this->descripcion_larga = '';

      $this->precio_normal = '';

      $this->precio_rebajado = '';

  }

    public function openModal()
    {
        $this->isOpen = true;
    }
  
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function modalInputFile($bool)
    {
        $this->inputFoto = $bool;
    }

    public function edit($id)
    {

        $productot = ModelsProducto::findOrFail($id);
        $this->nombre =$productot->nombre;
        $this->descripcion_corta = $productot->descripcion_corta;
        $this->descripcion_larga = $productot->descripcion_larga;
        $this->precio_rebajado = $productot->precio_rebajado;
        $this->precio_normal = $productot->precio_normal;

        $this->modalInputFile(false);
        $this->openModal();

    }

    public function delete($id)
    {
        //dd("sdksk");
        $producto = ModelsProducto::find($id);
        unlink('storage/'.$producto->foto);
        $producto->delete();
        
        session()->flash('message', 'Producto Eliminado Correctamente.');

    }
}
