<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Agregar un nuevo comentario
    public function store(Request $request, $imageId)
    {
        $request->validate([
            'content' => 'required|max:255', // Validación del contenido del comentario
        ]);

        $image = Image::findOrFail($imageId);

        $image->comments()->create([
            'user_id' => auth()->id(), // Asociar el comentario al usuario autenticado
            'content' => $request->content,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Comentario agregado');
    }
}
