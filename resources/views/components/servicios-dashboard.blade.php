@if($servicios->count())
<div class="md:grid md:grid-cols-4 grid grid-cols-1 mt-3 gap-4">
    @foreach($servicios as $s)
        <!-- Article -->
        <article class="inline overflow-hidden rounded-md shadow-xl mt-4 sm:mt-5 md:mt-4 dark:text-white border-2 border-white">
            <a href="{{ route('servicio.venta.show',$s->slug) }}">
                <img alt="{{ $s->nombre }}" class="block h-auto w-full" src="{{asset('storage/'.$s->foto)}}">
            </a>
            <div class="flex items-center  flex-col justify-between leading-tight p-2 md:p-4">
                <h1 class="text-lg">
                    <a class="no-underline hover:underline text-black dark:text-white" href="{{ route('servicio.venta.show',$s->slug) }}">
                    {{ substr($s->nombre,-35) }}
                    </a>
                </h1>
                <p class="text-grey-darker text-3xl mt-5">
                    ${{ number_format($s->precio_normal,2,',','.') }}
                </p>
                <p class="text-grey-darker line-through text-lg text-red-400 mb-4">
                    ${{ number_format($s->precio_rebajado,2,',','.') }}
                </p>
                <p class="text-grey-darker text-sm text-green-400 mb-4">
                    Tiene {{ $s->productos->count() }} productos en oferta
                </p>
                <a href="{{ route('servicio.venta.show',$s->slug) }}" class="btn-buy-services  transform hover:-translate-y-1 motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>
                    Comprar
                </a>
                @if( auth()->user()->suscribedService($s->id))
                    <a href="{{ route('servicio.renovar.show',$s->slug) }}" class="btn-renovar-services mt-3 w-2 transform hover:-translate-y-1 motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        Renovar
                    </a>
                @endif
            </div>
        </article>
    @endforeach
</div>
<div class="dark:bg-gray-800 bg-white  px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
    {{ $servicios->appends(['productos' => $productos->currentPage()])->links() }}
</div>
@else
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
    No Hay Resultados para la busqueda {{$this->search}}
    </div>
@endif