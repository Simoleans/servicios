<!-- step 2 -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8"  x-show=" index == false"  
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 transform scale-90"
                                                x-transition:enter-end="opacity-100 transform scale-100"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 transform scale-100"
                                                x-transition:leave-end="opacity-0 transform scale-90">
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
        <button x-on:click="index = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Volver</button>

        <form wire:submit.prevent="update" method="POST" enctype="multipart/form-data">
            <h2 class="m-4 font-bold text-2xl	">Editar Servicio</h2>
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
            <hr>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Editar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        
                        <button @click="index = true" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cerrar
                        </button>
                    </span>
                </div>
        </form>
    </div>
    <!-- cuadro de ciclos -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mt-4">
        @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <h2 class="m-2 font-bold text-2xl	">Ciclos de {{ $this->nombre }}</h2>
        <div class="container mx-auto px-4 py-4">
            <button x-on:click="$wire.createCiclo({{ $s->servicio_id ?? null }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Agregar Ciclo</button>

            {{-- <div class="md:grid md:grid-cols-3 grid grid-cols-1 mt-3 gap-4"> --}}
            <div class="flex flex-wrap gap-3">
                @foreach($ciclos as $s)
                    <!-- Article -->
                    <article class=" flex-grow inline overflow-hidden rounded-md shadow-md mt-4 sm:mt-5 md:mt-4 border-2 border-gray-600">
                        <div class="flex items-center flex-col justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <p class="text-grey-darker text-2xl mt-5">
                                    {{ $this->meses($s->mes) }}
                                </p>
                                <p class="text-grey-darker text-2xl mt-5">
                                    {{ $s->porcentaje }}%
                                </p>
                            </h1>
                        </div>
                        <div class="grid grid-cols-2">
                            <button wire:click="deleteCiclo({{ $s->id }})" wire:target="deleteCiclo({{ $s->id }})" wire:loading.class="cursor-not-allowed" class="bg-red-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Eliminar
                            </button>
                            <button wire:click="editCiclo({{ $s->id }})" class="bg-green-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Editar
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    @include('servicios.modal.edit-ciclo')
</div>
