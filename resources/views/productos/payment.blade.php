<x-app-layout>
    <x-slot name="header">
            Pagar Producto
    </x-slot>
    <div x-data="data()">
        <livewire:product-payment-component :slug="$slug" :producto="$producto" />

        <x-form-mercado-pago-producto :producto="$producto" />
    </div>
</x-app-layout>
<script>
    function data(){
        return{
            amount : ''
        }
    }
</script>

