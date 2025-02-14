<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

// Ruta principal, muestra la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();

// Ruta para la página de inicio después de autenticación
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas para la gestión de estudiantes
Route::middleware('auth')->group(function () {
    // Ruta para obtener y mostrar todos los estudiantes
    Route::get('students/show', [StudentController::class, 'showStudent'])->name('students.show');

    // Ruta para eliminar un estudiante de la base de datos
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Ruta para redirigir a la vista de los estudiantes después de eliminar uno
    Route::get('/students', [StudentController::class, 'showStudent'])->name('students.showStudent');

    // Ruta para mostrar el formulario de creación de estudiante
    Route::get('/students/create', [StudentController::class, 'showCreateForm'])->name('students.create');

    // Ruta para procesar y crear un nuevo estudiante
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');

    // Ruta para mostrar el formulario de actualización de estudiante
    Route::get('/students/update/{id}', [StudentController::class, 'showUpdateForm'])->name('students.updateForm');

    // Ruta para procesar y actualizar un estudiante
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    
    // Rutas para la gestión de usuarios
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
});
