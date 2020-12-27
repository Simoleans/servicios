<div class="py-12" x-data="{openModal : false}" x-init="openModal = false" >
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 border-2 border-white dark:bg-gray-800">
          @if (session()->has('message'))
              <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                  <div>
                    <p class="text-sm">{{ session('message') }}</p>
                  </div>
                </div>
              </div>
          @endif
          <button x-on:click="openModal = !false" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Producto</button>
         
          @include('productos.modal.create')
         
          
          <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model="search" placeholder="Buscar">
          @if($productos->count())
            <div class="md:grid md:grid-cols-3 grid grid-cols-1 mt-3 gap-4">
                @foreach($productos as $p)
                    <!-- Article -->
                    <article class="inline overflow-hidden rounded-md shadow-xl mt-4 sm:mt-5 md:mt-4 border-white border-2">
                        <a href="{{ route('payment-product',['id' => $p->id]) }}">
                            <img alt="Placeholder" class="block h-auto w-full" src="{{asset('storage/'.$p->foto)}}">
                        </a>
                        <div class="flex items-center  flex-col justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black dark:text-white" href="{{ route('payment-product',['id' => $p->id]) }}">
                                {{ substr($p->descripcion_larga,0,75) }}
                                </a>
                            </h1>
                            <p class="text-grey-darker text-3xl mt-5">
                                ${{ number_format($p->precio_normal,2,',','.') }}
                            </p>
                            <a href="#" class="btn-buy-services motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-green-700 mt-4">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg> --}}
                                Editar
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="dark:bg-gray-800 bg-white  px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
                {{ $productos->links() }}
            </div>
            @else
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 dark:bg-gray-800">
                No Hay Resultados para la busqueda {{$this->search}}
                </div>
            @endif
      </div>
  </div>
</div>



