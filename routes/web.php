<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta principal, muestra la página de inicio
Route::get('/', [HomeController::class, 'index']);

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
// Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
// Route::get('/students', [StudentController::class, 'show']);
// // Ruta para mostrar todos los estudiantes
// Route::get('/students/create', [StudentController::class, 'store'])->name('students.newStudent');
// // Route::get('/students/create', [StudentController::class, 'newStudent'])->name('students.newStudent');
// Route::post('/students', [StudentController::class, 'store'])->name('students.store');
// Route::get('/students/update/{id}', [StudentController::class, 'uptStudent'])->name('students.uptStudent');
// Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
// // Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
// Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');