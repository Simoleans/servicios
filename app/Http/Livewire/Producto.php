<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto as ModelsProducto;

class Producto extends Component
{
    use WithFileUploads;

    public $search, $nombre, $descripcion_corta,$foto,$descripcion_larga,$precio_rebajado,$precio_normal,$producto_id;
    public $isOpen = false;
    public $inputFoto = true;
    

    public function render()
    {
        return view('livewire.producto',['productos' => ModelsProducto::where('nombre','LIKE',"%{$this->search}%")->paginate(15)]);
    }

    public function create()
    {
        $this->modalInputFile(true);
        $this->resetInput();
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
  
        
        session()->flash('message', 
            'Producto Creado Correctamente.');
  
        $this->closeModal();
        $this->resetInput();
    }

    public function resetInput()
    {

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
        $this->resetInput();
    }

    /* para mostrar el input de foto */
    public function modalInputFile($bool)
    {
        $this->inputFoto = $bool;
    }

    public function edit($id)
    {
        
        $productot = ModelsProducto::findOrFail($id);
        $this->producto_id = $id;
        $this->nombre =$productot->nombre;
        $this->descripcion_corta = $productot->descripcion_corta;
        $this->descripcion_larga = $productot->descripcion_larga;
        $this->precio_rebajado = $productot->precio_rebajado;
        $this->precio_normal = $productot->precio_normal;

        $this->modalInputFile(true);
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|unique:productos,nombre,'.$this->producto_id,
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'precio_rebajado' => 'required',
            'precio_normal' => 'required',
        ]);
        $producto = ModelsProducto::findOrfail($this->producto_id);

        $producto->update([
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            // 'foto' => $this->foto->store('fotos/productos', 'public',ModelsProducto::slugify($this->nombre).'.'.$this->foto->extension()),
            'foto' => $this->foto != NULL ? ($this->foto != $producto->foto ? $this->foto->store('fotos/productos', 'public',ModelsProducto::slugify($this->nombre).'.'.$this->foto->extension()) : $producto->foto) : $producto->foto,
            'precio_rebajado' => $this->precio_rebajado,
            'precio_normal' => $this->precio_normal
        ]);
  
        
        session()->flash('message', 
            'Producto Editado Correctamente.');
  
        $this->closeModal();
        $this->resetInput();
    }

    public function delete($id)
    {
       
        $producto = ModelsProducto::find($id);
        Storage::delete($producto->foto);
        //unlink('storage/'.$producto->foto);
        $producto->delete();
        
        session()->flash('message', 'Producto Eliminado Correctamente.');

    }
}
