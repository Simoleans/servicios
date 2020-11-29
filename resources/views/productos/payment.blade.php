<x-app-layout>
    <x-slot name="header">
            Pagar Producto
    </x-slot>
    <div x-data="data()">
        @if(isset($slug))
            <livewire:product-payment-component :slug="$slug" :producto="$producto" />
        @else
            <livewire:product-payment-component :producto="$producto" />
        @endif
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

