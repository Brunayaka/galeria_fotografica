<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Galería Fotográfica</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">

    <!-- Contenedor Principal -->
    <div class="min-h-screen flex items-center justify-center">

        <!-- Tarjeta de Ingreso -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full">
            <div class="text-center mb-6">
                <!-- Título Principal -->
                <h1 class="text-3xl font-semibold text-gray-800">Iniciar sesión</h1>
                <!-- Descripción -->
                <p class="mt-2 text-lg text-gray-500">Accede para ver y compartir tus fotos.</p>
            </div>

            <!-- Formulario de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Campo Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Campo Contraseña -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Recordarme -->
                <div class="mb-4 flex items-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded text-indigo-600 focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                    </label>
                </div>

                <!-- Botón de Login -->
                <div class="flex items-center justify-between mb-4">
                    <!-- Enlace para recuperar contraseña -->
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif

                    <!-- Botón para Iniciar sesión -->
                    <x-primary-button class="ml-3 bg-indigo-600 hover:bg-indigo-700 text-white">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Enlace para volver atrás -->
            <div class="text-center mt-6">
                <button onclick="window.history.back()" class="text-sm text-gray-600 hover:text-gray-900 font-semibold">
                    ← Volver atrás
                </button>
            </div>

            <!-- Enlace de Registro -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">{{ __('Crear cuenta') }}</a></p>
            </div>
        </div>

    </div>

</body>
</html>
