<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el parámetro 'sort' (opcional)
        $sort = $request->get('sort', 'default'); // Valor por defecto: 'default'

        // Consultar las imágenes con relaciones necesarias
        $images = Image::with(['comments.user', 'user']);

        // Aplicar ordenación según el valor del parámetro 'sort'
        switch ($sort) {
            case 'votes':
                $images = $images->withCount('votes')->orderByDesc('votes_count');
                break;

            case 'alphabetical':
                $images = $images->orderBy('title', 'asc');
                break;

            case 'comments':
                $images = $images->withCount('comments')->orderByDesc('comments_count');
                break;

            default:
                $images = $images->latest(); // Orden por defecto: más recientes
        }

        // Obtener el resultado final
        $images = $images->get();

        return view('gallery.index', compact('images'));
    }

    public function vote(Request $request, Image $image)
    {
        $user = $request->user();
    
        // Verificar si el usuario ya votó por esta imagen
        if ($image->votes()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Ya has votado por esta imagen.');
        }
    
        // Registrar el voto
        $image->votes()->create([
            'user_id' => $user->id,
        ]);
    
        return back()->with('success', '¡Gracias por tu voto!');
    }
    
}
