
<div x-show="show == '{{$isOpen}}'">
    <x-jet-modal maxWidth="3xl">
      <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
        <h2 class="m-4 font-bold text-2xl	">Crear Ticket</h2>
        <hr>
        <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4 mt-2">
            <div class="col-span-2">
              <label class="block uppercase tracking-wide text-gray-700 col-span-2 text-xs font-bold mb-2" for="grid-first-name">
                Codigo
              </label>
              <x-jet-input wire:model.defer="codigo" type="text" placeholder="Código"/>
              <x-jet-input-error for="codigo" class="mt-2" />
            </div>
            <div>
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Tipo de ticket
              </label>
              <select wire:model.defer="tipo" class="block appearance-none w-full   border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="">Seleccione...</option>
                <option value="p">Porcentaje</option>
                <option value="f">Monto fijo</option>
              </select>
              <x-jet-input-error for="tipo" class="mt-2" />
            </div>
            <div >
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Monto
              </label>
              <x-jet-input type="number" wire:model.defer="monto" placeholder="Monto"/>
              <x-jet-input-error for="monto" class="mt-2" />
            </div>
            <div class="col-span-2">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Fecha de Expedición
              </label>
              <x-jet-input type="date" min="{{ \Carbon\Carbon::today()->addDay()->format('Y-m-d') }}" wire:model.defer="fecha_exp" />
              <x-jet-input-error for="fecha_exp" class="mt-2" />
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Crear
                </button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                
                <button @click="show = !true" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Cerrar
                </button>
            </span>
        </div>
      </form>
    </x-jet-modal>
  </div>
   
  
  