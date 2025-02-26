@extends('layouts.app')

@section('content')
   <div class="container mt-5">
    <h1>Lista de Estudiantes</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Idioma</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->language }}</td>                   
                </tr>
            @endforeach
        </tbody>
    </table>
   </div>

@vite(['resources/css/app.css', 'resources/js/app.js'])

@endsection