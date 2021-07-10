<x-app-layout>
    <x-slot name="header">
            Pagar
    </x-slot>
    <div x-data="data()">
        @if (session()->has('message'))
            <div class="bg-green-100 border-t-4 w-full border-green-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
                <div>
                <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
            </div>
        @endif
        <div class="grid grid-cols-3"> <!-- inicio de todo -->
            <livewire:subscriptions-component :ciclo="$ciclo" :slug="$slug" />
            <x-form-mercado-pago :ciclo="$ciclo" :renovated="$renovated" />
        </div> <!-- fin de todo -->
        
    </div>
</x-app-layout>
<script>
    function data(){
        return{
            amount : ''
        }
    }
</script>

