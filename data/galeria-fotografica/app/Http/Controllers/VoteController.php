<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store($imageId)
    {
        $image = Image::findOrFail($imageId);

        // Verifica si el usuario ya votó por esta imagen
        if (Vote::where('user_id', auth()->id())->where('image_id', $imageId)->exists()) {
            return redirect()->back()->with('error', '¡Ya votaste por esta imagen!');
        }

        // Registra el voto
        Vote::create([
            'user_id' => auth()->id(),
            'image_id' => $imageId,
        ]);

        // Incrementa el contador de votos de la imagen
        $image->increment('votes');

        return redirect()->back()->with('success', '¡Voto registrado!');
    }
}
