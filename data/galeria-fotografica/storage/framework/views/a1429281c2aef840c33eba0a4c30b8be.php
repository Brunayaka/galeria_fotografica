<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen | Galería Fotográfica</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">

    <!-- Contenedor Principal -->
    <div class="min-h-screen flex items-center justify-center">

        <!-- Tarjeta de Subida de Imagen -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full">
            <div class="text-center mb-6">
                <!-- Título -->
                <h1 class="text-3xl font-semibold text-gray-800">Subir Imagen</h1>
                <!-- Descripción -->
                <p class="mt-2 text-lg text-gray-500">Comparte tu imagen con la comunidad y agrega un título y descripción.</p>
            </div>

            <!-- Formulario de Subida de Imagen -->
            <form action="<?php echo e(route('images.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- Título -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" id="title" class="mt-1 p-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Escribe un título para la imagen" required>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <input type="text" name="description" id="description" class="mt-1 p-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Escribe una breve descripción" required>
                </div>

                <!-- Imagen -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700">Seleccionar Imagen</label>
                    <input type="file" name="image" id="image" accept="image/*" class="mt-1 p-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
                </div>

                <!-- Botón Subir Imagen -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Subir Imagen
                    </button>
                </div>
            </form>

            <!-- Enlace para Volver a la Galería -->
            <div class="mt-6 text-center">
                <a href="<?php echo e(route('images.index')); ?>" class="text-sm text-indigo-600 hover:underline">
                    Volver a la Galería
                </a>
            </div>

        </div>

    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/images/upload.blade.php ENDPATH**/ ?>