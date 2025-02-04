<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $unsplashKey = env('UNSPLASH_API_KEY');
    
        $response = Http::get("https://api.unsplash.com/photos/random", [
            'client_id' => $unsplashKey,
            'query' => 'landscape', // Puedes cambiarlo por otra categoría
            'orientation' => 'landscape'
        ]);
    
        $imageUrl = $response->json()['urls']['regular'] ?? null;
    
        return view('home', compact('imageUrl'));
    }
}
