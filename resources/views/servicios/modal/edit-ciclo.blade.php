<div x-show="show == true" x-cloak>
    <x-jet-modal maxWidth="3xl">
      @if($updateCiclo)
        <form wire:submit.prevent="updateCiclo" method="POST" enctype="multipart/form-data">
      @else
        <form wire:submit.prevent="storeCiclo" method="POST" enctype="multipart/form-data">
      @endif
        <h2 class="m-4 font-bold text-2xl	">{{ $updateCiclo ? 'Editar' : 'Crear' }} ciclo de {{ $this->nombre }}</h2>
        <input type="hidden" wire:model="ciclo_id">
        <hr>
        <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4 mt-2">
            <div>
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Meses
              </label>
              <x-jet-input wire:model="mesCiclo" type="number" placeholder="Mes" required/>
              <x-jet-input-error for="mes" class="mt-2" />
            </div>
            <div >
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name" required>
                Porcentaje de Descuento
              </label>
              <x-jet-input type="text" wire:model="porcentaje" placeholder="Porcentaje % de descuento"/>
              <x-jet-input-error for="porcentaje" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 grid-rows-1 px-4 py-4">
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                  <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    {{ $updateCiclo ? 'Editar' : 'Crear' }}
                  </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                  <button @click="show = !true" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cerrar
                  </button>
                </span>
            </div>
        </div>
      </form>
    </x-jet-modal>
  </div>