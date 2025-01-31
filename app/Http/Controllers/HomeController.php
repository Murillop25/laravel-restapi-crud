<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Hacer una solicitud GET a la API de Unsplash
        $response = Http::get('https://api.unsplash.com/photos/random', [
            'client_id' => env('UNSPLASH_API_KEY')  // Asegúrate de tener tu API key de Unsplash en el archivo .env
        ]);

        // Obtener la URL de la imagen
        $imageUrl = $response->json()[0]['urls']['regular'];

        // Pasar la URL de la imagen a la vista
        return view('home', compact('imageUrl'));
    }
}
