<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería Fotográfica | Dashboard</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">

    <!-- Contenedor Principal -->
    <div class="min-h-screen flex items-center justify-center">

        <!-- Tarjeta del Dashboard -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl w-full">
            <!-- Barra superior con enlaces -->
            <div class="flex justify-between items-center mb-6">
                <!-- Botón de Cerrar sesión -->
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>

                <!-- Enlaces de navegación -->
                <div class="flex space-x-4">
                    <!-- Enlace a Subir Imagen -->
                    <a href="{{ route('images.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Subir Nueva Imagen
                    </a>

                    <!-- Enlace a la Galería -->
                    <a href="{{ url('gallery') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        Ir a la Galería
                    </a>
                </div>
            </div>

            <!-- Título -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Galería Fotográfica</h1>
                <p class="mt-2 text-lg text-gray-500">Aquí están las imágenes que has subido. Puedes añadir más imágenes en cualquier momento.</p>
            </div>

            <!-- Galería de Imágenes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($images as $image)
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $image->title }}</h2>
                    <p class="text-gray-600">{{ $image->description }}</p>

                    <!-- Botón de eliminar solo si el usuario autenticado es el dueño -->
                    @if (auth()->id() === $image->user_id)
                    <form action="{{ route('images.destroy', $image) }}" method="POST" class="mt-4" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                            Eliminar
                        </button>
                    </form>
                    @endif

                    <!-- Mostrar los comentarios -->
                    <div class="mt-4">
    <h3 class="font-semibold">Comentarios:</h3>

    <!-- Contenedor de comentarios con límite inicial -->
    <div class="comments-container" id="comments-{{ $image->id }}">
        @foreach ($image->comments as $key => $comment)
        <div class="comment-item {{ $key >= 4 ? 'hidden' : '' }}" data-image-id="{{ $image->id }}">
            <strong>{{ $comment->user->name }}:</strong>
            <p>{{ $comment->content }}</p>
        </div>
        @endforeach
    </div>

    <!-- Botón para ver más comentarios -->
    @if ($image->comments->count() > 4)
    <button 
        class="view-more-comments mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300"
        data-image-id="{{ $image->id }}">
        Ver más
    </button>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const viewMoreButtons = document.querySelectorAll('.view-more-comments');

        viewMoreButtons.forEach(button => {
            button.addEventListener('click', () => {
                const imageId = button.getAttribute('data-image-id');
                const commentsContainer = document.querySelector(`#comments-${imageId}`);
                const hiddenComments = commentsContainer.querySelectorAll('.comment-item.hidden');

                // Mostrar todos los comentarios ocultos
                hiddenComments.forEach(comment => comment.classList.remove('hidden'));

                // Ocultar el botón de "Ver más" después de mostrar los comentarios
                button.style.display = 'none';
            });
        });
    });
</script>



                </div>
                @endforeach
            </div>

        </div>

    </div>

</body>

</html>
