{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto px-4 py-4">
                <div class="grid grid-flow-col gap-4 grid-rows-1">
                    <form class="w-full">
                        <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                          <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Nombre
                            </label>
                            <input id="grid-first-name" type="text" placeholder="Jane">
                          </div>
                          <div >
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                              Descripción(Corta)
                            </label>
                            <input  id="grid-last-name" type="text" placeholder="Doe">
                          </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                            <div>
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Descripción
                              </label>
                              <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane"></textarea>
                            </div>
                            <div >
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Foto
                              </label>
                              <input  id="grid-last-name" type="file" placeholder="Doe">
                            </div>
                          </div>
                          <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                            <div>
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Precio Normal
                              </label>
                              <input type="number">
                            </div>
                            <div >
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Precio rebajado
                              </label>
                              <input  type="number">
                            </div>
                          </div>
                          <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                            <div>
                              <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                                Guardar
                              </button>
                              <a class="text-blue-500 hover:text-blue-800 gap-6" href="#">
                                Volver
                              </a>
                            </div>
                          </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="py-12">
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
          <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Producto</button>
          @if($isOpen)
              @include('productos.modal.create')
          @endif
          <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model="search" placeholder="Buscar">
          @if($productos->count())
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
                    @foreach($productos as $p)
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
            {{ $productos->links() }}
          </div>
          @else
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
              No Hay Resultados para la busqueda {{$search}}
            </div>
          @endif
      </div>
  </div>
</div>



