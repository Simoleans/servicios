@if (session()->has('message'))
    <div class="bg-green-100 border-t-4 w-full border-green-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
    <div class="flex">
        <div>
        <p class="text-sm">{{ session('message') }}</p>
        </div>
    </div>
    </div>
@endif
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 w-full gap-1" x-data="data()" 
                                                                         x-init="window.addEventListener('total', event => {
                                                                                    let inputAmount = document.getElementById('amount');
                                                                                    let inputTicket = document.getElementById('ticket_id');
                                                                                    inputAmount.setAttribute('value', event.detail.amount);
                                                                                    inputTicket.setAttribute('value', event.detail.ticket);
                                                                                }) " >
                                                                                
    <!-- section ticket y precio -->
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py- dark:bg-gray-800 border-2 border-white">
                <article class="inline overflow-hidden rounded-md shadow-md mt-4 sm:mt-5 md:mt-4">
                    <div class="flex items-center flex-col justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline font-bold hover:underline text-black dark:text-white" href="#">
                            {{ $ciclo->servicio->nombre }}
                            </a>
                        </h1>
                        <p class="text-grey-darker text-3xl mt-5">
                            {{ $this->meses($this->ciclo->mes) }}
                        </p>
                    </div>
                    @if($ticketExists)
                    <div class="flex flex-wrap flex-row justify-around leading-tight p-2 ml-8 md:p-4">
                        <p class="text-grey-darker text-sm mt-5 flex-initial">
                            TICKET<br>
                        </p>
                        <p class="text-grey-darker text-sm mt-5 mb-4 flex-initial">
                            <span class="font-semibold text-lg">-{{ $porcentTicket }}%</span>
                            <button title="Quitar Ticket" wire:click="removeTicket" class="px-4 rounded-r-lg rounded-l-lg bg-red-500 hover:bg-red-700 text-white font-bold p-2 uppercase border-red-500 border-t border-b border-r">X</button>
                        </p>
                    </div>
                    @endif
                </article>
                @if(!$ticketExists)
                <form wire:submit.prevent="addTicket" method="POST" class="m-4 flex flex-col">
                    <input class="rounded-l-lg p-4 border-t mr-0 border-b border-l  -gray-800 border-gray-200 bg-white" wire:model.defer="codigo" placeholder="Ticket De Descuento" required/>
                    <x-jet-input-error for="codigo" class="mt-1 mb-1" />
                    <button {{ $ticketExists ?? 'disabled' }} class="px-8 rounded-r-lg rounded-l-lg bg-blue-500 hover:bg-blue-700 text-white font-bold p-4 uppercase border-blue-500 border-t border-b border-r" type="submit">Aplicar Ticket</button>
                </form>
                @endif
                </div>
        </div> 
    </div>
    <!-- fin -->

    <!-- section descuentos etc -->
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 dark:bg-gray-800 border-2 border-white">
                <h1 class="font-extrabold">PRECIO</h1>
                <article class="inline overflow-hidden rounded-md shadow-md mt-4 sm:mt-5 md:mt-4">
                    <div class="flex items-center flex-col justify-between leading-tight p-2 md:p-4">
                        <p class="text-grey-darker text-3xl mt-5">
                            ${{ number_format($ciclo->servicio->precio_normal,2,',','.') }} /Mensual
                        </p>
                    </div>
                    <div class="flex flex-wrap flex-row justify-around leading-tight p-2 ml-8 md:p-4">
                        <p class="text-grey-darker text-sm mt-5 flex-initial">
                            {{ $this->ciclo->mes }}x<br>
                            <strong>TOTAL A PAGAR</strong><br>
                            Ahorras
                        </p>
                        <p class="text-grey-darker text-sm mt-3 mb-4 flex-initial">
                            $ {{ $this->priceServiceWithPorcent($this->ciclo->porcentaje) }}<br>
                            <strong>$ {{ session('amount') }}</strong><br>
                            <span class="{{ $this->ciclo->porcentaje > 0 ? 'text-red-600 font-semibold text-lg' : '' }}">{{ $this->ciclo->porcentaje }}%</span>
                        </p>
                    </div>
                </div>
        </div> 
    </div>
    <!-- fin -->
</div>
  
    
    
    
    