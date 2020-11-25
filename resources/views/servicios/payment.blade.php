<x-app-layout>
    <x-slot name="header">
            Pagar
    </x-slot>
    <div x-data="data()">
        <livewire:subscriptions-component :ciclo="$ciclo" :slug="$slug" />
        <x-form-mercado-pago :ciclo="$ciclo" />
    </div>
</x-app-layout>
<script>
    function data(){
        return{
            amount : ''
        }
    }
</script>

