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
              {{-- <table class="table-fixed w-full">
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
                          <button wire:loading.class.remove="hover:bg-red-700" wire:loading.class="cursor-not-allowed"	wire:click="delete({{ $p->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded  cursor-not-allowed">Eliminar</button>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table> --}}
              <div class="md:grid grid-cols-3 mt-3 gap-4">
                @foreach($servicios as $p)
                {{-- <div class="max-w-sm rounded shadow-lg">
                  <img class="max-w-full h-45" src="{{asset('storage/'.$p->foto)}}" alt="Sunset in the mountains">
                  <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                    <p class="text-gray-700 text-base">
                      {{ $p->descripcion_larga }}
                    </p>
                  </div>
                  <div class="px-6 pt-4 pb-2">
                    <button wire:loading.class.remove="hover:bg-red-700" wire:loading.class="cursor-not-allowed"	wire:click="delete({{ $p->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded  cursor-not-allowed">Eliminar</button>
                    <button wire:loading.class.remove="hover:bg-red-700" wire:loading.class="cursor-not-allowed"	wire:click="delete({{ $p->id }})" class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded  cursor-not-allowed">Eliminar</button>
                  </div>
                </div> --}}
                  <div class="wrapper max-w-xs bg-gray-50 rounded-b-md shadow-lg mb-2">
                     <div>
                        <img class="object-cover h-60 w-full" src="{{asset('storage/'.$p->foto)}}" alt="montaña" />
                     </div>
                     <div class="p-3 space-y-3">
                        <h3 class="text-gray-700 font-semibold text-md">
                           {{ $p->nombre }}
                        </h3>
                        <p class="text-sm text-gray-900 leading-sm">
                           {{ $p->descripcion_larga }}
                        </p>
                     </div>
                     <div class=" pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                      </div>
                     <div class="grid grid-cols-2">
                        <button class="bg-teal-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-teal-500">
                            Agregar Producto
                        </button>
                        <button class="bg-red-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-red-500">
                            Eliminar
                        </button>
                     </div>
                  </div>
                @endforeach
              </div>
            <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
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
  
  
  
  