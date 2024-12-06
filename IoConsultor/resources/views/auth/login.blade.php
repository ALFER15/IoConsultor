<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-red-500">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden w-3/4 max-w-5xl">

            <!-- Sección del formulario -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-800 text-center">IoConsultor</h2>
                <p class="text-sm text-gray-600 text-center mt-2">
                    Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Register Now</a>
                </p>

                <!-- Mostrar errores de validación -->
                <x-validation-errors class="mt-4" />

                @if (session('status'))
                    <div class="mt-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-label for="email" value="{{ __('Email Address') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <!-- Contraseña -->
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- Recordar sesión -->
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember Me') }}</span>
                        </label>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <div class="mt-6">
                        <x-button class="w-full bg-red-500 hover:bg-black-600 text-white">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>

                <!-- Olvidé mi contraseña -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Sección de ilustración -->
            <div class="w-1/2 bg-indigo-900 relative flex items-center justify-center">
                <img src="{{ asset('https://img.lovepik.com/background/20211022/large/lovepik-medical-service-background-image_500704359.jpg') }}" class="size-full" alt="Rocket Illustration">
            </div>
        </div>
    </div>
</x-guest-layout>
