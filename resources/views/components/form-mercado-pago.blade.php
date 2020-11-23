{{-- <div class="bg-white rounded-lg p-6">
	<form class="max-w-full max-w-lg" action="{{ route('pagos.payment') }}" method="POST" id="paymentForm">
    @csrf
     <input type="hidden" name="transactionAmount" id="amount" wire:model="amount" />
      <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
      <input type="hidden" name="description" id="description" />
	  <div class="flex flex-wrap -mx-3 mb-6">
	    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
	      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
	        Email
	      </label>
	      <input class="form-input w-full" id="email" type="text" placeholder="Jane">
	    </div>
	    <div class="w-full md:w-1/3 px-3">
	      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
	        Document Type
	      </label>
	      <select class="form-input w-full" id="docType" name="docType" data-checkout="docType" type="text" required="">
	      	  <option>Seleccione...</option>
	          <option>RUT</option>
	          <option>Otro</option>
	        </select>
	    </div>
      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          Document Number
        </label>
        <input class="form-input w-full" id="docNumber" name="docNumber" data-checkout="docNumber" type="text">
      </div>
	  </div>
    <div class="divide-y divide-orange-400">
      <div class="text-center py-2">DETALLES DE LA TARJETA</div>
      <div class="text-center py-2"></div>
    </div>

	  <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          CARD HOLDER
        </label>
        <input class="form-input w-full" id="cardholderName" data-checkout="cardholderName" type="text">
      </div>
      <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          MES
        </label>
        <input class="form-input w-full" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                          onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
      </div>
      <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          AÑO
        </label>
        <input class="form-input w-full" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                          onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
      </div>
    </div>
     <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cardNumber">
          CARD NUMBER
        </label>
        <input class="form-input w-full input-background" id="cardNumber" data-checkout="cardNumber"
                        onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          CVV
        </label>
        <input id="securityCode" data-checkout="securityCode" type="text" class="form-input w-full"
                        onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
      </div>
      <div id="issuerInput" class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          ISSUER
        </label>
        <select id="issuer" name="issuer" data-checkout="issuer" class="form-input w-full"></select>
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          installment
        </label>
        <select type="text" id="installments" name="installments" class="form-input w-full"></select>
      </div>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Sign In
      </button>
    </div>
	</form>    
</div> --}}
<div class="py-5" >
  <!-- CARDS Productos -->
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
          <h1 class="font-extrabold">PAGAR</h1>
          <div class="bg-white rounded-lg p-6">
              <form class="max-w-full max-w-lg"  action="{{ route('pagos.payment') }}" method="POST" id="paymentForm">
              @csrf
              {{-- <script
              src="https://www.mercadopago.com.co/integrations/v1/web-tokenize-checkout.js"
              data-public-key="TEST-6f22bafe-83c8-404d-8a82-87dc995920c0"
              data-transaction-amount="{{ session('amount') }}"
              data-customer-id="675920985-GoURMRqfokqpGf"
              data-card-ids="1518023392627,1518023332143">
            </script> --}}
            {{-- <script
              src="https://www.mercadopago.com.co/integrations/v1/web-tokenize-checkout.js"
              data-public-key="TEST-6f22bafe-83c8-404d-8a82-87dc995920c0"
              data-transaction-amount="{{ session('amount') }}">
            </script> --}}
                <input type="hidden" name="transactionAmount" id="amount" value="{{ session('amount') }}" />
                <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                <input type="hidden" name="description" id="description" />
                <input type="hidden" name="issuer" id="issuer">
                <input type="hidden" name="installments" id="installments">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="grid-first-name">
                      Email
                    </label>
                    <input class="form-input w-full bg-gray-300" readonly value="{{ auth()->user()->email }}" id="email" type="text" name="email">
                  </div>
                  <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                      Tipo de documento
                    </label>
                    <select class="form-input w-full" id="docType" name="docType" data-checkout="docType" type="text" required="">
                          <option>Seleccione...</option>
                        <option>RUT</option>
                        <option>Otro</option>
                      </select>
                  </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Número de documento
                  </label>
                  <input class="form-input w-full" id="docNumber" name="docNumber" data-checkout="docNumber" type="text">
                </div>
                </div>
              <div class="divide-y divide-orange-400">
                <div class="text-center py-2">DETALLES DE LA TARJETA</div>
                <div class="text-center py-2"></div>
              </div>
          
                <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    titular
                  </label>
                  <input class="form-input w-full" id="cardholderName" data-checkout="cardholderName" type="text">
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    MES
                  </label>
                  <input class="form-input w-full" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                                    onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    AÑO
                  </label>
                  <input class="form-input w-full" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                                    onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cardNumber">
                    Número de la tarjeta
                  </label>
                  <input class="form-input w-full input-background" id="cardNumber" data-checkout="cardNumber"
                                  onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off type="text">
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    CVV
                  </label>
                  <input id="securityCode" data-checkout="securityCode" type="text" class="form-input w-full"
                                  onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    DESCRIPCIÓN
                  </label>
                 <input type="text" class="form-input w-full input-background" name="description" id="description">
                </div>
                {{-- <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    installment
                  </label>
                  <select type="text" id="installments" name="installments" class="form-input w-full"></select>
                </div> --}}
              </div>
              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="button_send" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                      <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                  </svg>
                  Pagar
                </button>
              {{--   <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                  Forgot Password?
                </a> --}}
              </div>
              </form>    
          </div>
      </div>
  </div> <!-- fin card productos -->
</div>


