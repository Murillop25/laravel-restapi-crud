@extends('layouts.app')

@section('content')
<div class="container mt-5 fade-in" id="home-container">
    <div class="text-center">
        <h1>Bienvenido&lpar;a&rpar;</h1>
        <p>¡Estamos felices de tenerte aquí! Disfruta de una imagen inspiradora de la naturaleza.</p>
    </div>

    <!-- Imagen de paisaje desde la API -->
    <div class="d-flex justify-content-center">
        <img src="{{ $imageUrl }}" alt="Paisaje" class="img-fluid rounded">
    </div>
</div>
@push('scripts')
    <script>
        window.onload = function() {
            const successMessage = @json(session('success'));
            const errorMessages = @json($errors->all());
            showAlerts(successMessage, errorMessages);
        };
    </script>
@endpush   
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection