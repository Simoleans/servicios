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
            <p class="font-bold py-5 px-5 bg-blue-500 text-xl">¡Extender Subscripción!</p>
            <hr>
            <div class="grid grid-cols-1 gap-4 px-4 py-4">
                <div>
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cantidad">
                    Meses
                  </label>
                  <x-jet-input wire:model.defer="cantidad" type="number" placeholder="Cantidad de meses" required/>
                  <x-jet-input-error for="cantidad" class="mt-2" />
                </div>
            </div>
           <hr>
            <div class=" flex flex-row-reverse gap-4 bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                <x-jet-secondary-button wire:click="closeModalExtender" >
                    {{ __('¡No quiero!') }}
                </x-jet-secondary-button>
                <button type="button" wire:click="extenderSubscription" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                    Extender
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>