<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center mb-8">Galería de Usuarios</h1>

        <!-- Enlace al Dashboard -->
        <div class="text-center mb-6">
            <a href="<?php echo e(route('dashboard')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                Volver al Dashboard
            </a>
        </div>

        <!-- Opciones de ordenación -->
        <div class="text-center mb-6">
            <span class="text-gray-600 font-semibold">Ordenar por:</span>
            <a href="<?php echo e(route('gallery.index', ['sort' => 'votes'])); ?>" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 mx-2">
                Más Votadas
            </a>
            <a href="<?php echo e(route('gallery.index', ['sort' => 'alphabetical'])); ?>" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 mx-2">
                Orden Alfabético
            </a>
            <a href="<?php echo e(route('gallery.index', ['sort' => 'comments'])); ?>" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition duration-300 mx-2">
                Más Comentarios
            </a>
        </div>

        <!-- Grid de imágenes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="<?php echo e(asset('storage/' . $image->path)); ?>" alt="<?php echo e($image->title); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                <h2 class="text-xl font-semibold"><?php echo e($image->title); ?></h2>
                <p class="text-gray-600">Subida por: <?php echo e($image->user->name); ?></p>
                <p class="text-gray-500 mt-2">Votos: <?php echo e($image->votes); ?></p>

                <?php if(!$image->votes()->where('user_id', auth()->id())->exists()): ?>
                <form action="<?php echo e(route('images.vote', $image)); ?>" method="POST" class="mt-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Votar</button>
                </form>
                <?php else: ?>
                <p class="text-green-500 mt-2">¡Ya votaste por esta imagen!</p>
                <?php endif; ?>

                <!-- Mostrar comentarios -->
                <div class="mt-4">
                    <h3 class="font-semibold">Comentarios:</h3>
                    <?php $__currentLoopData = $image->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mt-2">
                        <strong><?php echo e($comment->user->name); ?>:</strong>
                        <p><?php echo e($comment->content); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Formulario para agregar un comentario -->
                <form action="<?php echo e(route('comments.store', $image->id)); ?>" method="POST" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="Añadir un comentario..."></textarea>
                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Comentar
                    </button>
                </form>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

</body>

</html><?php /**PATH /var/www/html/resources/views/gallery/index.blade.php ENDPATH**/ ?>