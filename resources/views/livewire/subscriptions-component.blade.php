<div>
    <div class="grid grid-cols-1 w-full gap-1">
        <div class="py-5" x-data="data()" >
            <!-- CARDS Productos -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <h1 class="font-extrabold">PLAN</h1>
                    <article class="inline overflow-hidden rounded-md shadow-md mt-4 sm:mt-5 md:mt-4">
                        <div class="flex items-center flex-col justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="#">
                                {{ $this->meses($this->ciclo->mes) }}
                                </a>
                            </h1>
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
                            <p class="text-grey-darker text-sm mt-5 mb-4 flex-initial">
                                $ {{ $this->priceServiceWithPorcent($this->ciclo->porcentaje) }}<br>
                                <strong>$ {{ $this->totalWithPorcent($this->ciclo->mes,$this->ciclo->porcentaje) }}</strong><br>
                                <span class="{{ $this->ciclo->porcentaje > 0 ? 'text-red-600 font-semibold text-lg' : '' }}">{{ $this->ciclo->porcentaje }}%</span>
                            </p>
                            
                        </div>
                       
                    </article>
                </div>
            </div> <!-- fin card productos -->
        </div>
    </div>
  </div>
  
    
    
    
    