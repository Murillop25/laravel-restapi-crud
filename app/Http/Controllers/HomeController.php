<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Hacer la solicitud GET a la API de Unsplash
        $response = Http::get('https://api.unsplash.com/photos/random', [
            'client_id' => env('UNSPLASH_ACCESS_KEY')  // Usar la clave de acceso configurada en .env
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
        return view('home', compact('imageUrl'));
    }
}
