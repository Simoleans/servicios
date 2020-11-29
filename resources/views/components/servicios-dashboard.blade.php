@if($servicios->count())
<div class="md:grid md:grid-cols-4 grid grid-cols-1 mt-3 gap-4">
    @foreach($servicios as $s)
        <!-- Article -->
        <article class="inline overflow-hidden rounded-md shadow-xl mt-4 sm:mt-5 md:mt-4">
            <a href="#">
                <img alt="Placeholder" class="block h-auto w-full" src="{{asset('storage/'.$s->foto)}}">
            </a>
            <div class="flex items-center  flex-col justify-between leading-tight p-2 md:p-4">
                <h1 class="text-lg">
                    <a class="no-underline hover:underline text-black" href="#">
                    {{ $s->descripcion_larga }}
                    </a>
                </h1>
                <p class="text-grey-darker text-3xl mt-5">
                    ${{ number_format($s->precio_normal,2,',','.') }}
                </p>
                <p class="text-grey-darker line-through text-lg text-red-400 mb-4">
                    ${{ number_format($s->precio_rebajado,2,',','.') }}
                </p>
                <a href="{{ route('servicio.venta.show',$s->slug) }}" class="btn-buy-services  transform hover:-translate-y-1 motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        Comprar
                </a>
                <img src="{{ asset('img/mp.jpg') }}" class="rounded-full h-8 w-25 mt-3">
                <p class="text-sm text-gray-900 leading-sm mt-6">
                    {{ $s->descripcion_larga }}
                </p>
                <div class="text-sm text-left text-gray-900 leading-sm mt-6">
                    <ul>
                        @foreach($s->ciclos as $c)
                            <li class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-6 h-6 inline-block mr-1 text-green-700" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            {{ $this->meses($c->mes) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </article>
    @endforeach
</div>
<div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
    {{ $servicios->appends(['productos' => $productos->currentPage()])->links() }}
</div>
@else
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
    No Hay Resultados para la busqueda {{$this->search}}
    </div>
@endif