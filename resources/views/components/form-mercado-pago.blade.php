
<div class="py-5" x-data="main()">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-wrap" id="tabs-id">
      <div class="w-full">
        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-black dark:text-white border-white border" :class="{'bg-blue-600' : tabActive == 'mercadopago'}" @click="changeAtiveTab(event,'mercadopago')">
              <img src="https://s2.googleusercontent.com/s2/favicons?domain=mercadolibre.com&sz=32" class="w-6 h-6 inline-block" alt="Mercadopago Payment"/>
              Mercadopago
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-black dark:text-white border-white border" :class="{'bg-blue-600' : tabActive == 'flow'}" @click="changeAtiveTab(event,'flow')">
              <img src="https://s2.googleusercontent.com/s2/favicons?domain=flow.cl&sz=32" class="w-6 h-6 inline-block" alt="Flow Payment Icon"/>
              Flow
            </a>
          </li>
        </ul>
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 dark:bg-gray-800 shadow-lg rounded">
          <div class="px-4 py-5 flex-auto">
            <div class="tab-content tab-space">
              <div :class="{ 'hidden' : tabActive != 'mercadopago' }" id="tab-mercadolibre">
                  <h1 class="font-extrabold">PAGAR</h1>
                  <div class="rounded-lg p-6">
                      <form action="{{ route('pagos.payment') }}" method="POST" id="paymentForm">
                      @csrf
                        <input type="hidden" name="transactionAmount" id="amount" value="{{ session('amount') }}"/>
                        <input type="hidden" name="ticket_id" id="ticket_id" />
                        <input type="hidden" name="servicio_id" value="{{ $servicio }}">
                        <input type="hidden" name="ciclo_id" value="{{ $ciclo }}">
                        <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                        <input type="hidden" name="description" id="description" />
                        <input type="hidden" name="issuer" id="issuer">
                        <input type="hidden" name="installments" id="installments">
                        <input type="hidden" name="renovated" value="{{ $renovated }}">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                              <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2 dark:text-white" for="grid-first-name">
                                Email
                              </label>
                              <input class="form-input w-full bg-gray-300" readonly value="{{ auth()->user()->email }}" id="email" type="text" name="email">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                              <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-last-name">
                                Tipo de documento
                              </label>
                              <select class="block bg-gray-200 border-transparent rounded-md p-3 focus:border-gray-500 text-black focus:ring-0 w-full mb-6" id="docType" name="docType" data-checkout="docType" type="text" required="">
                                <option>Seleccione...</option>
                                <option>RUT</option>
                                <option>Otro</option>
                              </select>
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                              <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                                Número de documento
                              </label>
                              <input class="form-input w-full" id="docNumber" name="docNumber" data-checkout="docNumber" type="text">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-3">
                            <!-- tarjeta imagen -->
                            <div class="w-full mx-auto bg-blue-400 rounded-lg overflow-hidden mb-4 hover:bg-blue-600 flex-1">
                              <div class="md:flex">
                                  <div class="w-full p-4">
                                      <div class="flex justify-between items-center text-white"> <span class="text-3xl font-bold">${{ session('amount') }}<small class="text-sm font-light"></small></span> <i class="fa fa-chevron-circle-up fa-2x text-gray-300"></i> </div>
                                      <div class="flex justify-between items-center mt-10">
                                          <h2 x-text="n_card" class="text-xl text-white font-extrabold tracking-widest"></h2>
                                      </div>
                                      <div class="mt-8 flex justify-between items-center text-white">
                                          <div class="flex flex-col"> <span class="font-bold text-gray-300 text-sm">Titular</span> <span class="font-bold" x-text="name"></span> </div>
                                          <div class="flex flex-col"> <img src="https://img.icons8.com/offices/80/000000/sim-card-chip.png" width="48" /> <div class="whitespace-nowrap "><span x-text="month">12</span>/<span x-text="year">12</span></div></div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <!-- fin tarjeta-->
                           <div class="flex flex-col flex-1">
                             <div class="flex flex-col md:flex-row">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                                    titular
                                  </label>
                                  <input class="form-input w-full" id="cardholderName" x-model="name" data-checkout="cardholderName" type="text">
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                                    MES
                                  </label>
                                  <input x-model="month" class="form-input w-full" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                                                    onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                                    AÑO
                                  </label>
                                  <input x-model="year" class="form-input w-full" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                                                    onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
                                </div>
                             </div>
                             <div class="flex flex-col md:flex-row">
                                <div class="w-full md:w-5/6 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="cardNumber">
                                    Número de la tarjeta
                                  </label>
                                  <input  x-model="n_card" class="form-input w-full input-background" id="cardNumber" data-checkout="cardNumber"
                                                  onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
                                </div>
                                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                                    CVV
                                  </label>
                                  <input id="securityCode" data-checkout="securityCode" type="text" class="form-input w-full"
                                                  onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                                </div>
                             </div>
                             <div class="flex">
                              <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                                  DESCRIPCIÓN
                                </label>
                               <input type="text" class="form-input w-full input-background" name="description" id="description">
                              </div>
                             </div>
                           </div>
                        </div>
                      <div class="flex flex-row-reverse items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="button_send" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                              <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                          </svg>
                          Pagar
                        </button>
                      </div>
                      </form>    
                  </div>
              </div>
              <div :class="{ 'hidden' : tabActive != 'flow' }" x-cloak id="tab-flow">
                <div class="flex flex-col">
                  <form action="{{ route('flow-payment') }}" method="POST" >
                    @csrf
                    <input type="hidden" name="transactionAmount" id="amount" value="{{ session('amount') }}"/>
                    <input type="hidden" name="ticket_id" id="ticket_id" />
                    <input type="hidden" name="servicio_id" value="{{ $servicio }}">
                    <input type="hidden" name="ciclo_id" value="{{ $ciclo }}">
                    <input type="hidden" name="renovated" value="{{ $renovated }}">
                    <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2 dark:text-white" for="grid-first-name">
                          Email
                        </label>
                        <input class="form-input w-full bg-gray-300"  required value="{{ auth()->user()->email }}" id="email" type="text" name="email">
                      </div>
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                          Asunto
                        </label>
                        <input class="form-input w-full" maxlength="80" name="subject" required placeholder="Asunto del pago">
                      </div>
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2" for="grid-first-name">
                          Número de documento
                        </label>
                        <input class="form-input w-full" required name="rut"  placeholder="Ingrese RUT" x-on:input.debounce.250ms="checkRut(rut)" id="rut"  type="text" >
                      </div>
                  </div>
                    <button type="submit" class="p-2 bg-blue-500 hover:bg-blue-700 rounded w-full">
                      <span class="text-center font-bold text-white">
                        PAGAR CON FLOW
                      </span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- fin card productos -->
</div>
<script>
   function main(){
    return {
      n_card : '',
      name: '',
      year : '',
      month: '',
      tabActive : 'mercadopago',
      changeAtiveTab(event,tabID) {
       this.tabActive = tabID;
      },
      checkRut(rut) {
          // Despejar Puntos
          var valor = rut.value.replace('.','');
          // Despejar Guión
          valor = valor.replace('-','');
          
          // Aislar Cuerpo y Dígito Verificador
          cuerpo = valor.slice(0,-1);
          dv = valor.slice(-1).toUpperCase();
          
          // Formatear RUN
          rut.value = cuerpo + '-'+ dv
          
          // Si no cumple con el mínimo ej. (n.nnn.nnn)
          if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
          
          // Calcular Dígito Verificador
          suma = 0;
          multiplo = 2;
          
          // Para cada dígito del Cuerpo
          for(i=1;i<=cuerpo.length;i++) {
          
              // Obtener su Producto con el Múltiplo Correspondiente
              index = multiplo * valor.charAt(cuerpo.length - i);
              
              // Sumar al Contador General
              suma = suma + index;
              
              // Consolidar Múltiplo dentro del rango [2,7]
              if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
        
          }
          
          // Calcular Dígito Verificador en base al Módulo 11
          dvEsperado = 11 - (suma % 11);
          
          // Casos Especiales (0 y K)
          dv = (dv == 'K')?10:dv;
          dv = (dv == 0)?11:dv;
          
          // Validar que el Cuerpo coincide con su Dígito Verificador
          if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
          
          // Si todo sale bien, eliminar errores (decretar que es válido)
          rut.setCustomValidity('');
      }
    }
  }
</script>


