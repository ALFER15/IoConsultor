<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-red-500">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden w-3/4 max-w-5xl">

            <!-- Sección del formulario -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-800 text-center">IoConsultor</h2>
                <p class="text-sm text-gray-600 text-center mt-2">
                    Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Login Now</a>
                </p>

                <!-- Mostrar errores de validación -->
                <x-validation-errors class="mt-4" />

                <form method="POST" action="{{ route('register') }}" class="mt-6">
                    @csrf

                    <!-- Nombre -->
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <!-- Contraseña -->
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <!-- Términos y condiciones -->
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <!-- Botón de registro -->
                    <div class="mt-6">
                        <x-button class="w-full bg-red-500 hover:bg-black-600 text-white">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>

            <!-- Sección de ilustración -->
            <div class="w-1/2 bg-indigo-900 relative flex items-center justify-center">
                <img src="{{ asset('https://img.lovepik.com/background/20211022/large/lovepik-medical-service-background-image_500704359.jpg') }}" class="size-full" alt="Medical Illustration">
            </div>
        </div>
    </div>
</x-guest-layout>
