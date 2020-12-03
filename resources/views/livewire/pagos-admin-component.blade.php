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
            <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model="search" placeholder="Buscar por servicio o producto">
            @if($pagos->count())
            <div class="overflow-auto">
              <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-20">Tipo</th>
                        <th class="px-4 py-2">Servicio/Producto</th>
                        <th class="px-4 py-2">Ticket Descuento</th>
                        <th class="px-4 py-2">Monto</th>
                    </tr>
                </thead>
                <tbody class="text-center sm:overflow-x-scroll">
                    @foreach($pagos as $p)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-2 py-2">{{ $p->servicio_id ? 'Servicio' : 'Producto' }}</td>
                        <td class="border px-4 py-2">
                          {{ $p->servicio->nombre ?? $p->producto->nombre }}
                        </td>
                        <td class="border px-4 py-2">{{ $p->ticket->codigo }}</td>
                        <td class="border px-4 py-2">${{ number_format($p->monto) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
             
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
              {{ $pagos->links() }}
            </div>
            @else
              <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                No Hay Resultados para la busqueda {{$search}}
              </div>
            @endif
        </div>
    </div>
  </div>
  
  
  
  
