<div class="py-12" x-data="{show : false}" x-init="show = false" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button x-on:click="show = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Servicio</button>
           
            @include('servicios.modal.create')
           
            
            <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model="search" placeholder="Buscar">
            @if($servicios->count())
              <table class="table-fixed w-full">
                  <thead>
                      <tr class="bg-gray-100">
                          <th class="px-4 py-2 w-20">No.</th>
                          <th class="px-4 py-2 w-20">Foto</th>
                          <th class="px-4 py-2">Nombre</th>
                          <th class="px-4 py-2">Descripción</th>
                          <th class="px-4 py-2">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($servicios as $p)
                      <tr>
                          <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                          <td class="border px-4 py-2">
                            <img src="{{asset('storage/'.$p->foto)}}">
                            <p class="text-xs">
                              <a href="#">Editar</a>
                            </p>
                          </td>
                          <td class="border px-4 py-2">{{ $p->nombre }}</td>
                          <td class="border px-4 py-2">{{ $p->descripcion_corta }}</td>
                          <td class="border px-4 py-2">
                          {{-- <button wire:click="edit({{ $p->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button> --}}
                           
                          <button wire:loading.class.remove="hover:bg-red-700" wire:loading.class="cursor-not-allowed"	wire:click="delete({{ $p->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded  cursor-not-allowed">Eliminar</button>
                          </td>
                      </tr>
                      @endforeach
                    
                  </tbody>
              </table>
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
              {{ $servicios->links() }}
            </div>
            @else
              <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                No Hay Resultados para la busqueda {{$search}}
              </div>
            @endif
        </div>
    </div>
  </div>
  
  
  
  