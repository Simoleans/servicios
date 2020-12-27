<div class="py-12"  x-data="ticket()"  
                    x-init="() => {
                      window.addEventListener('show', event => {
                          show = false;
                      })               
                    }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 dark:bg-gray-800 border-2 border-white">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button x-on:click="show = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Ticket</button>
           
            @include('ticket.modal.create')
           
              <div class="flex items-center border-b border-gray-900 dark:border-white py-2 w-full">
                <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full dark:text-white text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                <div class="pr-7">
                  <div  wire:loading wire:target="search" class="spinner"></div>
                </div>
              </div>
            @if($tickets->count())
              <div class="md:grid grid-cols-3 mt-3 gap-4">
                @foreach($tickets as $t)
                  <div class="px-2">
                    <div class="bg-white px-4 py-4 flex my-2 rounded-lg shadow">
                      <div class="w-24 pr-5">
                        <a href="#" class="mb-4">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="dark:text-black">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd" />
                            <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                          </svg>
                        </a>
                      </div>
                      <div class="flex-1" @click="copy($event)">
                        <h2 class="font-bold text-gray-700 my-0">{{ $t->codigo }}</h2>
                        <h2 class="font-bold text-gray-700 my-0">{{ $t->monto }}</h2>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 dark:bg-gray-800 sm:px-6">
              {{ $tickets->links() }}
            </div>
            @else
              <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                No Hay Resultados para la busqueda {{$search}}
              </div>
            @endif
        </div>
    </div>
  </div>

  <script>
    function ticket()
    {
      return {
        show : false,
        copy(event)
        {
          window.prompt("Copie el codigo: Ctrl+C ", event.target.innerText);
           document.execCommand('copy');
          
        }
      }
    }
  </script>
  
  
  
  