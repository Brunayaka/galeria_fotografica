<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería Fotográfica</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">

    <!-- Contenedor Principal -->
    <div class="min-h-screen flex items-center justify-center">

        <!-- Tarjeta de Bienvenida -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full">
            <div class="text-center mb-6">
                <!-- Título Principal -->
                <h1 class="text-3xl font-semibold text-gray-800">Bienvenido a la Galería Fotográfica</h1>
                <!-- Descripción -->
                <p class="mt-2 text-lg text-gray-500">Conecta con la comunidad y comparte tus momentos favoritos.</p>
            </div>

            <!-- Botones de Login y Registro -->
            <div class="space-y-4">
                
                <!-- Botón Login -->
                <a href="<?php echo e(route('login')); ?>" class="block text-center py-3 px-6 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transform transition duration-300">
                    Iniciar sesión
                </a>

                <!-- Botón Registro -->
                <a href="<?php echo e(route('register')); ?>" class="block text-center py-3 px-6 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transform transition duration-300">
                    Crear una cuenta
                </a>
            </div>
        </div>

    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>