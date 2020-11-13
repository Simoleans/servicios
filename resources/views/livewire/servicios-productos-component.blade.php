<div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
      <div class="py-5" x-data="openModal()">
        @include('servicios.modal.productos')
          <!-- CARDS Productos -->
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                  <h1 class="font-extrabold">PRODUCTOS DISPONIBLES</h1>
                  <div class="flex items-center border-b border-gray-900 py-2 w-full">
                      <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                      <div class="pr-7">
                        <div  wire:loading wire:target="search" class="spinner"></div>
                      </div>
                    </div>
                      @if($productos->count())
                      <div class="md:grid grid-cols-2 mt-3 gap-4">
                          @foreach($productos as $p)
                          <div class="wrapper max-w-xs bg-gray-50 rounded-b-md shadow-lg mb-2" >
                              <div>
                                  <img class="object-cover h-60 w-full" src="{{asset('storage/'.$p->foto)}}" alt="montaña" />
                              </div>
                              <div class="p-3 space-y-3">
                                  <h3 class="text-gray-700 font-semibold text-md">
                                  {{ $p->nombre }}
                                  </h3>
                              </div>
                              <div class=" pt-4 pb-2">
                                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">${{ $p->precio_normal }}</span>
                              </div>
                              <div class="grid grid-cols-1">
                                  <button @click="open(event)" id="{{ $p->id }}"  nombre="{{ $p->nombre }}" class="bg-teal-600 justify-center py-2 text-center text-white font-semibold transition duration-300 hover:bg-teal-500">
                                      Agregar Producto
                                  </button>
                              </div>
                          </div>
                          @endforeach
                      </div>
                          <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
                          {{ $productos->links() }}
                          </div>
                      @else
                      <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                          No Hay Resultados para la busqueda {{$search}}
                      </div>
                      @endif
                    
              </div>
          </div> <!-- fin card productos -->
      </div>
      <div class="py-5" >
          <!-- CARDS Productos -->
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                  <h1 class="font-extrabold">PRODUCTOS DE ESTE SERVICIO <span wire:loading wire:target="addProductToService" class="spinner pt-5 pl-7"></span></h1>
              @if($productos->count())
                <div class="md:grid grid-cols-2 mt-3 gap-4">
                  <!-- loading -->
                  <div wire:loading wire:target="addProductToService" class="wrapper space-y-2 animate-pulse max-w-xs  rounded-b-md shadow-lg mb-2">
                    <div>
                      <div class="object-cover h-60 w-full bg-gray-400"  alt="montaña"> </div>
                    </div>
                    <div class="">
                      <div class="bg-gray-400 h-30 w-full"> </div>
                    </div>
                    <div class="space-y-2">
                      <div class="h-4 bg-gray-400 rounded"></div>
                      <div class="h-4 bg-gray-400 rounded w-5/6"></div>
                    </div>
                    <div class="grid grid-cols-1 bg-gray-400">
                      <div class="bg-gray-600 justify-center py-2 text-white font-semibold transition duration-300" >
                      </div>
                    </div>
                </div>
                <!-- fin loading -->
                  @foreach($serviciosProductos as $p)
                    <div class="wrapper max-w-xs bg-gray-50 rounded-b-md shadow-lg mb-2">
                      <div>
                          <img class="object-cover h-60 w-full" src="{{asset('storage/'.$p->producto->foto)}}" alt="montaña" />
                      </div>
                      <div class="p-3 space-y-3">
                          <h3 class="text-gray-700 font-semibold text-md">
                            {{ $p->producto->nombre }}
                          </h3>
                      </div>
                      <div class=" pt-4 pb-2">
                          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">${{ $p->producto->precio_normal }}</span>
                        </div>
                      <div class="grid grid-cols-1">
                          <button class="bg-red-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-red-500"  wire:click="deleteProductToService({{ $p->id }})">
                              Eliminar
                          </button>
                      </div>
                    </div>
                  @endforeach
                </div>
                  <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
                  {{ $serviciosProductos->links() }}
                  </div>
              @else
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                  No Hay Resultados para la busqueda {{$search}}
                </div>
              @endif
              </div>
          </div> <!-- fin card productos -->
      </div>
  </div>
</div>



<script>
  function openModal() {
        return {
          show : false,
          disabledField : false,
          productoNombre: '',
          id : '',
          porcentaje : "",
          check : '',
          producto_id : '',
          printData : (e,attr) => e.target.getAttribute(attr),
          isOpen() { return this.show === true },
          isClose() {  
            this.show = false 
            this.resetInput();
          },
          open(e) { 
            //alert(this.printData(e,'id'))
              this.productoNombre = this.printData(e,'nombre');
              this.$refs.pID.value = this.printData(e,'id');
              this.show = true;
          },
          printGratis(e) {
            if(e.target.checked){
              this.porcentaje = 100;
              this.disabledField = true;
            }else{
              this.porcentaje = '';
              this.disabledField = false;
            }
          },
          store(){
            //envio el formulario a mi componente emitiendo unos datos
            window.livewire.emit('productoHidden', this.$refs.pID.value);

            //escucho mi componente para recibir datos del componentes renderizados en JS UNA MARAVILLA
            window.addEventListener('modal', event => {
                this.isClose();
            })
          },
          resetInput() {
            this.porcentaje = '';
            this.disabledField = false;
            this.$refs.pID.value = '';
          }
        }
    }

    
</script>

  
  
  
  