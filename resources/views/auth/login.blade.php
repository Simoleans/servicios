<x-guest-layout>
    <div x-data="login()">
        <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <p class="text-xl mt-4 font-bold text-center">{{ nameApp() }}</p>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" x-show="showRegistar == false" x-transition:enter="transition ease-out duration-900" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-900" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
            @csrf
            <div>
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4 mb-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

           <!--  <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar') }}</span>
                </label>
            </div> -->

            <div class="flex items-center justify-center mt-4 gap-3">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 flex-1" @click="clickShow()">
                    {{ __('Registrate') }}
                </a>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
                
                <x-jet-button class="ml-4 text-center">
                    {{ __('Entrar') }}
                </x-jet-button>
            </div>
        </form>

        <form method="POST" action="{{ route('register') }}" x-show="showRegistar == true" x-transition:enter="transition ease-out duration-900" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-900" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
            @csrf

            <div>
                <x-jet-label value="{{ __('Name') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Confirm Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" @click="clickShowLogin()">
                    {{ __('¿Ya estas registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    </div>
</x-guest-layout>
<script>
    function login()
    {
        return {
           showRegistar : false,
            clickShow(){
                // alert(this.showRegistar)
                this.showRegistar = true;
            },
            clickShowLogin(){
                // alert(this.showRegistar)
                this.showRegistar = false;
            }
        }
    }
</script>


