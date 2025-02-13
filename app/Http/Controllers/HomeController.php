<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // Hacer la solicitud GET a la API de Unsplash
       $unsplashKey = env('UNSPLASH_API_KEY');
       $response = Http::get("https://api.unsplash.com/photos/random", [
        'client_id' => $unsplashKey,
        'query' => 'landscape', // Puedes cambiarlo por otra categoría
        'orientation' => 'landscape'
    ]);

    // Verificar si la respuesta es válida y contiene una imagen
    $imageData = $response->json();

    // Verificar si se ha recibido una imagen
    if (!empty($imageData) && isset($imageData[0]['urls']['regular'])) {
        $imageUrl = $imageData[0]['urls']['regular'];
    } else {
        // Si no hay imágenes, establecer una URL por defecto
        $imageUrl = 'https://via.placeholder.com/800x600.png?text=Imagen+de+Paisaje+No+Disponible';
    }

    // Pasar la URL de la imagen a la vista

    $imageUrl = $response->json()['urls']['regular'] ?? null;

    return view('home', compact('imageUrl'));
    }
}
