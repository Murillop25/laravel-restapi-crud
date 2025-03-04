<?php

use Illuminate\Support\Facades\Route;
//home
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
//students
use App\Http\Controllers\Student\StudentController;
//auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
//user
use App\Http\Controllers\UserController;

Auth::routes();

// Ruta por defecto: Login
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta de registro
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas para la gestión de estudiantes (solo para maestros y directores)
    Route::middleware('role:maestro,director,admin')->group(function () {
        Route::get('/students/show', [StudentController::class, 'showStudent'])->name('students.show');
        Route::get('/students/create', [StudentController::class, 'showCreateForm'])->name('students.create');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/update/{id}', [StudentController::class, 'showUpdateForm'])->name('students.updateForm');
        Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    });

    // Rutas de eliminación solo para directores
    Route::middleware('role:director,admin')->group(function () {
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    // Rutas para admin, supervisores, maestros y directores (pueden ver la lista de estudiantes)
    Route::middleware('role:supervisor,maestro,director,admin')->group(function () {
        Route::get('/students/list', [StudentController::class, 'listStudent'])->name('students.list');
    });

    // Rutas para admin, supervisores, maestros y directores (pueden ver el editar perfil)
    Route::middleware('role:supervisor,maestro,director,admin')->group(function () {
        Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    });

    // Rutas de asignación de roles (Solo Admin)
    Route::middleware('role:admin')->group(function () {
        Route::get('/assign-role', [RoleController::class, 'showAssignRoleForm'])->name('assign.role');
        Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign.role.process');
    });
});
