<div x-show="show == true">
    <x-jet-modal maxWidth="3xl">
        <input type="hidden" x-model="produ_id"  x-ref="pID">
        <h2 class="m-4 font-bold text-2xl	">Agregar (<strong x-text="productoNombre"></strong>) a este servicio</h2>
        <hr>
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>Escriba el porcentaje (%) de descuento del producto que va asociar a esté servicio. Si es gratis, marque la casilla de gratis.</p>
        </div>
        <div class="flex items-center bg-orange-500 text-white text-sm font-bold px-4 py-3" role="alert">
          <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
          <p>Si lo quiere dejar con el precio original, deje el formulario vacio</p>
      </div>
        <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4 mt-2">
            <div>
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Porcentaje de Descuento (%)
              </label>
              <x-jet-input wire:model="porcentaje" type="text" pattern="\d*" maxlength="3" min="1" max="100" x-model="porcentaje"  x-bind:readonly="disabledField == true" placeholder="Porcentaje" required/>
              <x-jet-input-error for="porcentaje" class="mt-2" />
            </div>
            <div >
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                GRATIS
              </label>
              <input class=" form-checkbox mr-2 leading-tight h-6 w-6 mt-3"  @click="printGratis($event)" x-model="check" value="true" type="checkbox">
              <x-jet-input-error for="descripcion_corta" class="mt-2" />
            </div>
        </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                  <button type="button" @click="store()" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                  Crear
                  </button>
              </span>
              <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                  <button @click="isClose()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                  Cerrar
                  </button>
              </span>
          </div>
    </x-jet-modal>
  </div>
   
  
  