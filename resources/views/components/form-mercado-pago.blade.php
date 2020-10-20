<div class="bg-white rounded-lg p-6">
	<form class="max-w-full max-w-lg" action="{{ route('pagos.payment') }}" method="POST" id="paymentForm">
    @csrf
     <input type="hidden" name="transactionAmount" id="amount" value="10" />
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
    {{--   <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
        Forgot Password?
      </a> --}}
    </div>
	</form>    
</div>


