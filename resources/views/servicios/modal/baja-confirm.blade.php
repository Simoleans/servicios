<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" >
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
    
      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
    
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" wire:model="subscription_id">
            <p class="font-bold py-5 px-5 bg-red-500 text-xl">¡Importante!</p>
            <hr>
            <p class="font-bold py-4 px-4 text-center text-2xl">¿Deseas DARTE DE BAJA de esté servicio?</p>
           <hr>
            <div class=" flex flex-row-reverse gap-4 bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                <x-jet-secondary-button wire:click="closeModal" >
                    {{ __('¡No quiero!') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="darseBaja" >
                    {{ __('Darse de baja') }}
                </x-jet-danger-button>
            </div>
        </form>
      </div>
    </div>
  </div>