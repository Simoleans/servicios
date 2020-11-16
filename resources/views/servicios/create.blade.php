
<div x-show="show == '{{$isOpen}}'" x-cloak 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90">
    <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
      <h2 class="m-4 font-bold text-2xl	">Crear Servicio</h2>
      <hr>
      <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4 mt-2">
       
          <div>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
              Nombre
            </label>
            <x-jet-input wire:model.defer="nombre" type="text" placeholder="Nombre" id="nombre"/>
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
      <div class="grid grid-cols-3 gap-4 grid-rows-1 px-4 py-4">
        <div>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Dias <br>de prueba
          </label>
          <x-jet-input type="number" wire:model.defer="dias_pruebas" />
          <x-jet-input-error for="dias_pruebas" class="mt-2" />
        </div>
        <div >
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            Días <br>de suspención
          </label>
          <x-jet-input  type="number" wire:model.defer="dias_suspender" />
          <x-jet-input-error for="dias_suspender" class="mt-2" />
        </div>
        <div>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Dias <br>para notificar
          </label>
          <x-jet-input type="number" wire:model.defer="dias_notificar" />
          <x-jet-input-error for="dias_notificar" class="mt-2" />
        </div>
    </div>
      @foreach ($arrayFormCiclo as $item => $key)
        <div class="grid grid-cols-3 gap-4 grid-rows-1 px-4 py-4" wire:key="servicio-ciclo-{{ $key }}">
          <div>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              Cantidad de meses
            </label>
            <x-jet-input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;"  wire:model.defer="serv.{{ $item }}.mes"/>
            <x-jet-input-error for="serv.{{ $item }}.mes" class="mt-2" />
            
          </div>
          <div @if($key == 0) class="col-span-2" @endif>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              Oferta(%)
            </label>
            <x-jet-input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;"  wire:model.defer="serv.{{ $item }}.oferta" />
            <x-jet-input-error for="serv.{{ $item }}.oferta" class="mt-2" />
          </div>
          <div>
            @if($key != 0)
            <button  wire:click="deleteInputCicloServicio({{ $item }})"   type="button" class="w-full block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-7">
              X
            </button>
            @endif
          </div>
        </div>
        @endforeach
      <div>
        <x-jet-input-error for="serv" class="mt-2" />
        <button  wire:click="addInputCicloServicio"  type="button" class="block text-center w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-7">
          Agregar Mes (Ciclos de pagos)
        </button>
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
</div>
 

