@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1>Bienvenido a la Página Principal</h1>
        <p>¡Estamos felices de tenerte aquí! Disfruta de una imagen inspiradora de la naturaleza.</p>
    </div>

    <!-- Imagen de paisaje desde la API -->
    <div class="mt-4">
        <img src="{{ $imageUrl }}" alt="Paisaje" class="img-fluid rounded">
    </div>
</div>
@endsection
