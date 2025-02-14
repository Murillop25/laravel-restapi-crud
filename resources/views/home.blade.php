@extends('layouts.app')
@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> --}}
        <div class="container mt-5">
            <div class="text-center">
                <h1>Bienvenido&lpar;a&rpar;</h1>
                <p>¡Estamos felices de tenerte aquí! Disfruta de una imagen inspiradora de la naturaleza.</p>
            </div>
        
            <!-- Imagen de paisaje desde la API -->
            <div class="mt-3">
            <div class="d-flex justify-content-center">
                <img src="{{ $imageUrl }}" alt="Paisaje" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
@endsection