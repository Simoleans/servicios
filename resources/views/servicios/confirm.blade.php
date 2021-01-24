<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirmación de pago') }}
        </h2>
    </x-slot>
    {{-- <div class="min-h-screen bg-gradient-to-b from-pink-100 to-pink-400 flex justify-center items-center">
        <div class="bg-white">
            @if (session()->has('message'))
            <div class="bg-green-500 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                    <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
                </div>
            @endif
            <div class="bg-blue-500">
                <form action="{{ route('redirect.app.flow') }}" method="POST">
                    @csrf
                    <button class="p-4 bg-blue-500 border">
                        Volver
                    </button>
                </form>
            </div>
        </div>
    </div> --}}
@php 
if ($data['status'] = 2) {
    $status = '<div class="bg-green-500 border-t-4 border-green-700 w-full rounded-b  px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex justify-center">
                            <p class="text-base">¡Has pagado correctamente!</p>
                        </div>
                    </div>';
}elseif($data['status'] = 1){
    $status = '<div class="bg-yellow-500 border-t-4 border-yellow-700 w-full rounded-b  px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex justify-center">
                            <p class="text-base">¡Su pago ha quedado pendiente!</p>
                        </div>
                    </div>';
}elseif($data['status'] = 3){
    $status = '<div class="bg-red-500 border-t-4 border-red-700 w-full rounded-b  px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex justify-center">
                            <p class="text-base">¡Su pago ha sido rechazado!</p>
                        </div>
                    </div>';
}elseif($data['status'] =4){
    $status = '<div class="bg-red-500 border-t-4 border-red-700 w-full rounded-b  px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex justify-center">
                            <p class="text-base">¡Su pago ha sido rechazado!</p>
                        </div>
                    </div>';
}else{
    $status = 'Mall';
}


@endphp
        <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5">
            <div class="w-full mx-auto rounded-lg bg-white shadow p-5 text-gray-800" style="max-width: 400px">
                <div class="w-full flex mb-4 items-center flex-col gap-4">
                    {!! $status !!}
                    
                    <div>
                        <p class="text-sm text-center">Orden</p>
                        <p class="font-bold text-3xl">{{ $data['flowOrder'] }}</p>
                    </div>
                    
                    <p>Monto : {{ number_format($data['amount'],2,',','.') }}</p>
                    <p>Email : {{ $data['payer'] }}</p>
                    <p>Asunto : {{ $data['subject'] }}</p>
                </div>
                <div class="w-full mb-4">
                    <form action="{{ route('redirect.app.flow') }}" method="POST">
                        @csrf
                        <button class="p-4 bg-blue-500 rounded w-full">
                            Volver
                        </button>
                    </form>
                </div>
            </div>
        </div>
</x-guest-layout>