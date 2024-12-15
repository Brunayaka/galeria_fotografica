<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Mostrar todas las imágenes en el dashboard
    public function index()
    {
        // Obtener solo las imágenes del usuario autenticado
        $images = Image::where('user_id', auth()->id())
                        ->with(['comments.user']) // Cargar relaciones necesarias
                        ->get();

        return view('dashboard', compact('images'));
    }

    // Mostrar el formulario para subir una nueva imagen
    public function create()
    {
        return view('images.create');
    }

    // Guardar la nueva imagen
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $path = $request->file('image')->store('images', 'public');
    
        Image::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'path' => $path,
            'user_id' => auth()->id(), // Añadimos el user_id del usuario autenticado
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Imagen subida correctamente.');
    }
    

    public function destroy(Image $image)
{
    // Verificar si el usuario autenticado es el dueño de la imagen
    if (auth()->id() !== $image->user_id) {
        return redirect()->route('dashboard')->with('error', 'No tienes permiso para eliminar esta imagen.');
    }

    // Eliminar el archivo físico de almacenamiento
    // if (Storage::exists($image->path)) {
    //     Storage::delete($image->path);
    // }

    // Eliminar el registro de la base de datos
    $image->delete();

    return redirect()->route('dashboard')->with('success', 'Imagen eliminada correctamente.');
}

}
