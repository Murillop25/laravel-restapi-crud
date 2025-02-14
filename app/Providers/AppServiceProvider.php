<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Student;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      // Compartimos la cantidad total de estudiantes en las vistas
      $total_students = Student::count();

      // Compartir la variable con todas las vistas
      View::share('total_students', $total_students);
    }
}
