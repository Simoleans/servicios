<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="grid grid-cols-1 md:grid-cols-4 ">
                <div class="text-gray-700 bg-white border border-gray-600 rounded px-2 py-2 m-2 w-full">
                    <div class="overflow-auto overflow-y-auto " style="height: 28rem">
                        @foreach($supports as $s)
                            <div class="md:flex {{ $supportID == $s->id ? 'bg-gray-400' : 'bg-gray-100' }} rounded-lg p-1 shadow-md mt-1">
                                <img class="h-8 w-8 md:h-8 md:w-8 rounded-full mx-auto md:mx-0 md:mr-6"  src="{{ $s->user->profile_photo_url }}">
                                <div class="text-center md:text-left">
                                    <h2 class="text-lg {{ $supportID == $s->id ? 'font-semibold' : '' }}" wire:click="$emit('showMessages','{{ $s->id }}')">{{ $s->tittle }}</h2>
                                    {{-- <div class="text-purple-500">{{ $s->user->name }}</div> --}}
                                    <div class="text-gray-600 text-sm">{{ $s->user->email }}</div>
                                    {{-- <div class="text-gray-600">(555) 765-4321</div> --}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="col-span-1 md:col-span-3 rounded  border border-gray-600 text-gray-700 text-center m-2" >
                    @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('message') }}</p>
                        </div>
                      </div>
                    </div>
                @endif
                    <div class="flex justify-between p-4 " style="background-color: #ECE5DD">
                        <div>
                            <h2 class="font-bold">{{ $name }}</h2>
                        </div>
                        <div>
                            @if($supportID != null)
                                    <button title="Ticket Resuelto" wire:click="archiveSupport()" class="bg-green-500 text-grey-darkest font-bold py-2 px-2 rounded inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 h-5 mr-2 text-white" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                            @endif
                            @if($closeButton)
                                <button wire:click="closeMessage" title="Mensajes Cerrados" class="bg-red-500 text-grey-darkest font-bold py-2 px-2 rounded inline-flex items-center">
                                    <svg class="fill-current w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                                        <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                                    </svg>
                                </button>
                            @else
                                <button wire:click="openMessage" title="Mensajes Abiertos" class="bg-green-500 text-grey-darkest font-bold py-2 px-2 rounded inline-flex items-center">
                                    <svg class="fill-current w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="overflow-auto p-2 shadow-inner" style="height: 25rem; background-color: #DCF8C6">
                        @foreach ($messages as $m)
                            <div class="{{ $m->user_id == auth()->user()->id ? 'text-left bg-green-200 mr-16' : 'text-right bg-white ml-16' }} rounded  shadow-md p-4 mb-2">
                                {{ $m->message }}
                                @if($m->file != null)
                                <br>
                                    <a  href="{{asset('storage/'.$m->file)}}" download class="bg-red-500 text-grey-darkest font-bold py-2 px-4 rounded inline-flex items-center mt-2">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                        <span>Descargar</span>
                                    </a>
                                @endif
                               <h2 class="{{ $m->user_id == auth()->user()->id ? 'text-right' : 'text-left' }} italic text-xs">{{ $m->created_at->diffForHumans() }}</h2>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if($showForm)
                <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-4 mt-1">
                        <div class="md:col-start-2  md:col-span-3">
                            <x-jet-input type="text" wire:model.defer="mensaje" class="h-14" placeholder="Mensaje"/>
                            <x-jet-input-error for="mensaje" class="mt-1 mb-1" />
                            <x-jet-input type="file" wire:model.defer="file" accept="image/png, image/jpeg"/>
                            <x-jet-input-error for="file" class="mt-2" />
                        
                        </div>
                    </div>
                    <div class="flex flex-row-reverse">
                        <div>
                            <button title="enviar Mensaje" class="px-4 max-w-auto rounded-r-lg rounded-l-lg bg-green-500 hover:bg-green-700 text-white font-bold p-2 uppercase border-green-500 border-t border-b border-r">Enviar</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
  </div>
  
  
  
  
