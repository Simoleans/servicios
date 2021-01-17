<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bold text-xl dark:text-white text-black" x-data="copyClipboard()">
    <div class="bg-white overflow-hidden shadow-md md:shadow-lg sm:rounded-lg dark:bg-gray-800 border-2 border-white">
        <div class="container mx-auto px-4 py-4">
            <div class="flex md:flex-row flex-col gap-4">
                <img alt="kaka" class="block h-44 bg-cover rounded-md" src="{{asset('storage/'.$servicio->foto)}}">
                <div class="flex-1">
                    <p class="text-2xl dark:text-white text-center">${{ number_format($servicio->precio_normal,2,',','.') }}</p>
                    <div class="flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-center">{{ $servicio->descripcion_larga }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row-reverse items-center gap-4 mt-4">
                           <div>
                                <button x-bind:disabled="copied" @click="copyURL()" class="bg-green-500 hover:bg-green-400 rounded  justify-center w-full py-2 px-2 text-center text-white font-semibold">
                                    <svg class="w-6 h-6 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                    <span x-text="copied == true ? 'URL Copiada!' : 'Copiar URL'"></span>
                                </button>
                            </div>
                            <div>
                                <button @click="redirectWhatsapp()" class="bg-green-500 hover:bg-green-400 rounded  justify-center w-full py-2 px-2 text-center text-white font-semibold">
                                    <svg class="w-6 h-6 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                    Whatsapp
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md md:shadow-lg sm:rounded-lg">
            <div class="container mx-auto px-4 py-4">
                @if($servicio->ciclos->count())
                <div class="md:grid md:grid-cols-3 grid grid-cols-1 mt-3 gap-4">
                    @foreach($servicio->ciclos as $s)
                        <!-- Article -->
                        <article class="inline overflow-hidden rounded-md shadow-md mt-4 sm:mt-5 md:mt-4 border-2 border-gray-600">
                            <div class="flex items-center flex-col justify-between leading-tight p-2 md:p-4">
                                <h1 class="text-lg">
                                    <a class="no-underline hover:underline text-black dark:text-white" href="#">
                                    {{ $this->meses($s->mes) }}
                                    </a>
                                </h1>
                                <p class="text-grey-darker text-3xl mt-5">
                                    ${{ number_format($servicio->precio_normal,2,',','.') }}
                                </p>
                                <p class="text-grey-darker text-sm mt-5 mb-4">
                                Mensual
                                </p>
                            </div>
                            <div class="flex flex-wrap flex-row justify-between leading-tight p-2 ml-4 md:p-4">
                                <p class="text-grey-darker text-sm mt-5">
                                    {{ $s->mes }}x<br>
                                    Subtotal<br>
                                    Ahorras
                                </p>
                                <p class="text-grey-darker text-sm mt-5 mb-4">
                                    $ {{ $this->priceServiceWithPorcent($s->porcentaje) }}<br>
                                    $ {{ $this->totalWithPorcent($s->mes,$s->porcentaje) }}<br>
                                    <span class="{{ $s->porcentaje > 0 ? 'text-red-600 font-semibold text-lg' : '' }}">{{ $s->porcentaje }}%</span>
                                </p>
                                
                                <p class="text-sm text-gray-900 leading-sm mt-6">
                                    {{ $s->descripcion_larga }}
                                </p>
                            </div>
                            <div class="flex flex-col md:flex-row lg:flex-row">
                                @if( request()->routeIs('servicio.renovar.show') )
                                    <a href="{{ route('payment_renovar_mercadopago_index',['slug' => $s->servicio->slug,'ciclo' => $s->id]) }}" class="btn-renovar-services  hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                        Renovar
                                    </a>
                                    <a href="{{ route('payment_renovar_mercadopago_index',['slug' => $s->servicio->slug,'ciclo' => $s->id]) }}" class="btn-renovar-services  hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                        Flow
                                    </a>
                                @else
                                    <a href="{{ route('payment_mercadopago_index',['slug' => $s->servicio->slug,'ciclo' => $s->id]) }}" class="btn-buy-services  hover:bg-green-700" title="Pagar con MercadoPago">
                                        <img src="https://s2.googleusercontent.com/s2/favicons?domain=mercadolibre.com&sz=32" class="w-6 h-6 inline-block" alt="Flow Payment Icon"/>
                                        
                                    </a>
                                    <a href="{{ route('payment_mercadopago_index',['slug' => $s->servicio->slug,'ciclo' => $s->id]) }}" class="btn-buy-services-flow  hover:bg-blue-700" title="Pagar con Flow">
                                        <img src="https://s2.googleusercontent.com/s2/favicons?domain=flow.cl&sz=32" class="w-6 h-6 inline-block" alt="Flow Payment Icon"/>
                                        
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
                {{-- <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
                    {{ $servicio->ciclos->links() }}
                </div> --}}
                @else
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    No Hay Resultados para la busqueda {{$search}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> 

<script>
    function copyClipboard()
    {
        return {
            copied : false,
            copiedURL() {
                this.copied = true;
            },
            noCopiedURL(){
                this.copied = false;
            },
            copyURL() {
                let inputFake = document.createElement('input');
                let  text = window.location.href;

                document.body.appendChild(inputFake);
                inputFake.value = text;
                inputFake.select();
                document.execCommand('copy');
                document.body.removeChild(inputFake);
                this.copiedURL();

                setInterval(() => {
                    this.noCopiedURL();
              }, 3000);
            },
            redirectWhatsapp(){
                window.open(' https://wa.me/?text=Compra aqui! '+window.location.href, '_blank');
            }
        }
    }
</script>
