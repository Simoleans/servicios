{{-- <div class="py-12" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
                <h2 class="m-4 font-bold text-2xl	">Configuración</h2>
                <hr>
                <div class="grid grid-cols-2 gap-4 grid-rows-1 px-4 py-4 mt-2">
                    <div class="col-span-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                        nombre de la aplicación
                        </label>
                        <x-jet-input wire:model.defer="nombre" type="text" placeholder="Nombre" id="nombre"/>
                        <x-jet-input-error for="nombre" class="mt-2" />
                    </div>
                    <div class="sm:col-span-2 col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Logo
                        </label>
                        <x-jet-input type="file" wire:model.defer="logo" />
                        <x-jet-input-error for="logo" class="mt-2" />
                    </div>
                    <div class="sm:col-span-2 col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Favicon
                        </label>
                        <x-jet-input type="file" wire:model.defer="favicon" />
                        <x-jet-input-error for="favicon" class="mt-2" />
                    </div>
                </div>
                <hr>
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
    </div>
  </div> --}}
  
  <x-jet-form-section submit="store">
    <x-slot name="title">
        {{ __('Configuración') }}
        @if (session()->has('message'))
  <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
    <div class="flex">
      <div>
        <p class="text-sm">{{ session('message') }}</p>
      </div>
    </div>
  </div>
@endif
    </x-slot>

    <x-slot name="description">
        {{ __('Configurar parámetros de la aplicación.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-jet-label value="{{ __('Configuración') }}" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nombre" value="{{ __('Nombre de Aplicación') }}" />
            <x-jet-input id="nombre" type="text" class="mt-1 w-full" wire:model.defer="nombre" required/>
            <x-jet-input-error for="nombre" class="mt-1 mb-1" />

            <x-jet-label for="logo" value="{{ __('Logo') }}" />
            <x-jet-input id="logo" type="file" class="mt-1 block w-full" wire:model.defer="logo"/>
            <x-jet-input-error for="logo" class="mt-1 mb-1" />

            <x-jet-label for="favicon" value="{{ __('Favicon') }}" />
            <x-jet-input id="favicon" accept="image/ico" type="file" class="mt-1 block w-full" wire:model.defer="favicon"/>
            <x-jet-input-error for="favicon" class="mt-1 mb-1" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>


  
  
  


