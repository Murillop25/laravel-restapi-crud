@extends('layouts.app')

@push('styles')
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1>Bienvenido&lpar;a&rpar;</h1>
        <p>¡Estamos felices de tenerte aquí! Disfruta de una imagen inspiradora de la naturaleza.</p>
    </div>

    <!-- Imagen de paisaje desde la API -->
    <div class="d-flex justify-content-center">
        <img src="{{ $imageUrl }}" alt="Paisaje" class="img-fluid rounded">
    </div>
</div>
@endsection
