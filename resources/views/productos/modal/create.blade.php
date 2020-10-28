<div x-show="openModal == true" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400 hidden" x-bind:class="{'hidden': !openModal}">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
    
      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
    
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                <div>
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Nombre
                  </label>
                  <x-jet-input wire:model.defer="nombre" type="text" placeholder="Nombre"/>
                  <x-jet-input-error for="nombre" class="mt-2" />
                </div>
                <div >
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Descripción(Corta)
                  </label>
                  <x-jet-input type="text" wire:model.defer="descripcion_corta" placeholder="Descripción corta"/>
                  <x-jet-input-error for="descripcion_corta" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                <div>
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Descripción(LARGA)
                  </label>
                  <textarea wire:model.defer="descripcion_larga" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white form-input rounded-md shadow-sm" id="grid-first-name" type="text" placeholder="Descripción Larga"></textarea>
                  <x-jet-input-error for="descripcion_larga" class="mt-2" />
                </div>
                @if($inputFoto)
                    <div>
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Foto
                    </label>
                    <x-jet-input type="file" wire:model.defer="foto" accept="image/png, image/jpeg"/>
                    <x-jet-input-error for="foto" class="mt-2" />
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4">
                <div>
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Precio Normal
                  </label>
                  <x-jet-input type="number" wire:model.defer="precio_normal" />
                  <x-jet-input-error for="precio_normal" class="mt-2" />
                </div>
                <div >
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Precio rebajado
                  </label>
                  <x-jet-input  type="number" wire:model.defer="precio_rebajado" />
                  <x-jet-input-error for="precio_rebajado" class="mt-2" />
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Crear
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    
                    <button @click="openModal = !true" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cerrar
                    </button>
                </span>
            </div>
        </form>
      </div>
    </div>
  </div>