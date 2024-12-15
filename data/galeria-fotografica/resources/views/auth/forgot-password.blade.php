<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Galería Fotográfica</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">

    <!-- Contenedor Principal -->
    <div class="min-h-screen flex items-center justify-center">

        <!-- Tarjeta de Recuperación de Contraseña -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full">
            <div class="text-center mb-6">
                <!-- Título Principal -->
                <h1 class="text-3xl font-semibold text-gray-800">Recuperar Contraseña</h1>
                <!-- Descripción -->
                <p class="mt-2 text-lg text-gray-500">¿Olvidaste tu contraseña? No te preocupes, te enviaremos un enlace para que puedas restablecerla.</p>
            </div>

            <!-- Formulario de Recuperación de Contraseña -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Campo Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Botón Enviar Enlace de Restablecimiento -->
                <div class="flex items-center justify-between mb-4">
                    <!-- Enlace para iniciar sesión -->
                    <p class="text-sm text-gray-600">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">{{ __('Iniciar sesión') }}</a></p>

                    <!-- Botón para enviar el enlace -->
                    <x-primary-button class="ml-3 bg-indigo-600 hover:bg-indigo-700 text-white">
                        {{ __('Enviar enlace de restablecimiento') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Enlace para volver atrás -->
            <div class="text-center mt-6">
                <button onclick="window.history.back()" class="text-sm text-gray-600 hover:text-gray-900 font-semibold">
                    ← Volver atrás
                </button>
            </div>

        </div>

    </div>

</body>
</html>
