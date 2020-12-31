<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\CicloServicio;
use App\Models\Subscriptions;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule; 


class ServiciosComponent extends Component
{

    use WithFileUploads;

    public $search, $nombre, $descripcion_corta,$foto,$descripcion_larga,$precio_rebajado,$precio_normal,$dias_pruebas,$dias_suspender,$dias_notificar,$mes,$porcentaje;
    //dynamic inputs ciclo de meses
    public $isOpen = true;
    public $inputFoto = true;
    public $editServicio = false;
    public $serv;

    public $modalAddUser = false;

    //input dynamic
    public $counter = 0;
    public $arrayFormCiclo = []; 
    public $indexEditar = true;
    public $ciclos = [];
    public $mesCiclo;
    public $ciclo_id;
    public $updateCiclo = false;
    public $servicio_id;
    public $servicio_id_add;
    public $emailUser;
    public $cantidad;
    public $ciclosAdd = [];

    public function render()
    {
        return view('livewire.servicios-component',[
                'servicios' => Servicios::where('nombre','LIKE',"%{$this->search}%")->where('status',1)->orderby('id','DESC')->paginate(6)
            ])->layout('layouts.app',['header' => 'Servicios']);
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|unique:productos',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'foto' => 'required|file|max:13000|mimes:png,jpeg',
            'precio_rebajado' => 'required|max:8|min:2',
            'precio_normal' => 'required|max:8|min:2',
            'dias_pruebas' => 'required',
            'dias_suspender' => 'required',
            'dias_notificar' => 'required',
            'serv.*.mes' => 'integer|required|max:36',
            'serv.*.oferta' => 'integer|required|max:100',
            'serv' => 'required|array|max:4'
        ],
        [
            'serv.*.mes.required' => 'El mes no puede quedar vacio.',
            'serv.*.oferta.required' => 'La oferta no puede quedar vacia.',
            'serv.*.mes.max' => 'El mes no puede pasar de 36.',
            'serv.*.oferta.max' => 'La oferta no puede pasar del 100%.',
            'serv.required' => 'Debe agregar al menos 1 ciclo de pago.',
            'serv.max' => 'Solo se permiten 4 ciclos de pago.'
        ]);
       
        $servicio = Servicios::create([
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            'foto' => $this->foto->store('fotos/servicios', 'public',Servicios::slugify($this->nombre).'.'.$this->foto->extension()),
            'precio_rebajado' => $this->precio_rebajado,
            'precio_normal' => $this->precio_normal,
            'dias_pruebas' => $this->dias_pruebas,
            'dias_suspender' => $this->dias_suspender,
            'dias_notificar' => $this->dias_notificar,
            'slug' => Servicios::slugify($this->nombre)
        ]);

        foreach($this->serv as $ciclo)
        {
            CicloServicio::create([
                'servicio_id' => $servicio->id,
                'mes' => $ciclo['mes'],
                'porcentaje' => $ciclo['oferta'],
            ]);
        }

        $this->dispatchBrowserEvent('show', ['show' => false]);
        
        session()->flash('message', 
            'Servicio Creado Correctamente.');
  
        $this->reset([
            'nombre',
            'descripcion_corta',
            'descripcion_larga',
            'foto',
            'precio_rebajado',
            'precio_normal',
            'dias_pruebas',
            'dias_suspender',
            'dias_notificar',
        ]);

        $this->arrayFormCiclo = [];
    }

    public function delete($id)
    {
        $service = Servicios::findOrfail($id);
        $service->status = 0;
        $service->save();

        session()->flash('message', 
            'Servicio Eliminado Correctamente.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

        
    /**
     * crear input dinamicos, llenando el array 
     *
     * @return array
     */
    public function addInputCicloServicio()
    {
        $i = $this->counter + 1;
        $this->counter = $i;
        array_push($this->arrayFormCiclo, $i);
    }
    
    /**
     * Borrar los input dinamicos de ciclos mensuales
     *
     * @param  int $key
     * @return array
     */
    public function deleteInputCicloServicio($key)
    {
        unset($this->arrayFormCiclo[$key]);
    }


    public function meses($mes)
    {
        $this->mes = $mes;

        $year = 12; //meses que es un año

        $operation = $this->mes / $year;

        if (is_float($operation)) {
            return $this->mes.' Mes(ses)';
        }else{
            return $operation.' Año(s)';
        }
    }

    public function edit($id)
    {
        $servicio = Servicios::findOrfail($id);
        $this->servicio_id = $id;
        $this->nombre = $servicio->nombre;
        $this->descripcion_corta = $servicio->descripcion_corta;
        $this->descripcion_larga = $servicio->descripcion_larga;
        $this->precio_normal = $servicio->precio_normal;
        $this->precio_rebajado = $servicio->precio_rebajado;
        $this->dias_pruebas = $servicio->dias_pruebas;
        $this->dias_suspender = $servicio->dias_suspender;
        $this->dias_notificar = $servicio->dias_notificar;  
         $this->foto = $servicio->foto;
        $this->getServicioCiclos($id);

        $this->dispatchBrowserEvent('index', ['index' => false]);
    }

    public function update()
    {
        $servicio = Servicios::findOrfail($this->servicio_id);

        $servicio->update([
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            'foto' => $this->foto != $servicio->foto ? $this->foto->store('fotos/servicios', 'public',Servicios::slugify($this->nombre).'.'.$this->foto->extension()) : $servicio->foto,
            'precio_rebajado' => $this->precio_rebajado,
            'precio_normal' => $this->precio_normal,
            'dias_pruebas' => $this->dias_pruebas,
            'dias_suspender' => $this->dias_suspender,
            'dias_notificar' => $this->dias_notificar,
        ]);

        session()->flash('message', 
            'Servicio Editado Correctamente.');
    }

    public function editCiclo($id)
    {
        $this->reset(['mesCiclo','porcentaje']);
        $this->updateCiclo = true;

        $ciclo = CicloServicio::findOrfail($id);

        $this->ciclo_id = $id;
        $this->mesCiclo = $ciclo->mes;
        $this->porcentaje = $ciclo->porcentaje;

        $this->dispatchBrowserEvent('editShow', ['show' => true]);
    }

    public function getServicioCiclos($id)
    {
        $this->ciclos = Servicios::findOrfail($id)->ciclos;
    }

    public function updateCiclo()
    {
        $this->validate([
            'ciclo_id' => 'required|numeric',
            'mesCiclo' => 'integer|required|max:36',
            'porcentaje' => 'integer|required|max:100',
        ]);

        $ciclo = CicloServicio::findOrfail($this->ciclo_id);

        $ciclo->update([
            'mes' => $this->mesCiclo,
            'porcentaje' => $this->porcentaje
        ]);

        $this->dispatchBrowserEvent('editShow', ['show' => false]);
        
        //devolver los ciclos nuevamente
        $this->getServicioCiclos($ciclo->servicio_id);

        session()->flash('message', 
            'Ciclo Editado Correctamente.');
    }

    public function createCiclo()
    {
        $this->reset(['mesCiclo','porcentaje']);
        $this->updateCiclo = false;
        
        $this->dispatchBrowserEvent('editShow', ['show' => true]);
    }

    public function storeCiclo()
    {
        $this->updateCiclo = false;

        $countCiclos = Servicios::findOrfail($this->servicio_id)->ciclos->count();

        if ($countCiclos == 4) {
            session()->flash('error', 
             'No se puede registrar. Debe tener maximo 4 ciclos por servicio.');
             return false;
        }

        CicloServicio::create([
            'servicio_id' => $this->servicio_id,
            'mes' => $this->mesCiclo,
            'porcentaje' => $this->porcentaje
        ]);

        //devolver los ciclos nuevamente
        $this->getServicioCiclos($this->servicio_id);

        session()->flash('message', 
            'Ciclo Creado Correctamente.');

        $this->dispatchBrowserEvent('editShow', ['show' => false]);
    }

    public function deleteCiclo($id)
    {
        $ciclo = CicloServicio::findOrfail($id);

        $countCiclos = Servicios::findOrfail($this->servicio_id)->ciclos->count();

        if ($countCiclos == 1) {
            session()->flash('error', 
             'No se puede Eliminar, debe tener al menos 1 ciclo activo.');
             return false;
        }

        $ciclo->delete();

        //devolver los ciclos nuevamente
        $this->getServicioCiclos($ciclo->servicio_id);

        session()->flash('error', 
            'Ciclo Eliminado Correctamente.');
    }

    public function confirmAddUSer($id)
    {
        $this->servicio_id_add = $id;
        $servicio = Servicios::findOrfail($id);
        $this->ciclosAdd = $servicio->ciclos;
        $this->openModalAddUser();
    }
    public function openModalAddUser()
    {
        $this->modalAddUser = true;
    }

    public function closeModalAddUser()
    {
        $this->modalAddUser = false;
        $this->emailUser = '';
        $this->cantidad = [];
        $this->servicio_id_add = '';
    }

    public function addUserStore()
    {
        $this->validate([
            'cantidad' => 'required',
            'emailUser' => 'required|email',
        ]);

        $user = User::whereEmail($this->emailUser)->first();

        if(!$user->exists()){
            return $this->addError('emailUser', 'Este usuario no existe en la base de datos.');
        }
        $ciclo = CicloServicio::findOrfail($this->cantidad);

        Subscriptions::create([
            'user_id' => $user->id,
            'servicio_id' => $this->servicio_id_add,
            'ciclo_id' => $this->cantidad,
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->addMonths($ciclo->mes)
        ]);

        session()->flash('message', 
            'Usuario inscrito a la subscripción.');
        $this->closeModalAddUser();
       
    }
}
