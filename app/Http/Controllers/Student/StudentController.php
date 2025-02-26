<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // public function index()
    // {
    //     $students = Student::all();
    //     return view('students.show', compact('students'));
    // }

    public function ListStudent()
    {
        // Obtén los estudiantes asociados al usuario autenticado
        $students = Student::all();

        return view('students.listStudent', compact('students'));
    }

    public function showStudent()
    {
        // Obtén los estudiantes asociados al usuario autenticado
        $students = Student::where('user_id', auth()->id())->get();

        return view('students.showStudent', compact('students'));
    }

    public function showCreateForm()
    {
        // Retorna la vista para crear un nuevo estudiante
        return view('students.newStudent');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student,email', // Aquí debe ser 'students' si el nombre de la tabla es 'students'
            'phone' => 'required|digits:8',
            'language' => 'required|in:English,Spanish,French',
        ]);
    
        // Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Crear el estudiante en la base de datos
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'language' => $request->language,
            'user_id' => auth()->id(),  // Asignar el user_id del usuario autenticado
        ]);
    
        // Si la creación falla, redirige con un mensaje de error
        if (!$student) {
            return redirect()->route('students.show')->with('error', 'Error al crear el estudiante.');
        }
    
        // Redirige a la vista de estudiantes con un mensaje de éxito
        return redirect()->route('students.show')->with('success', 'Estudiante creado correctamente.');
    }
    
    //Muestra un estudiante
    public function show($id)
    {
        // Buscar el estudiante con el ID proporcionado, pero solo si pertenece al usuario autenticado
        $student = Student::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        // Si el estudiante no existe o no pertenece al usuario autenticado
        if (!$student) {
            return redirect()->route('students.show')->with('error', 'Estudiante no encontrado o no tienes permiso para verlo.');
        }

        // Si todo está bien, mostrar la vista con el estudiante
        return view('students.showStudent', compact('student'));
    }

    // Eliminar un estudiante
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('students.show')->with('error', 'Estudiante no encontrado.');
        }

        $student->delete();

        return redirect()->route('students.show')->with('success', 'Estudiante eliminado correctamente.');
    }

    // Mostrar el formulario de actualización de estudiante
    public function showUpdateForm($id)
    {
        // Buscar el estudiante por ID, pero asegurándonos de que pertenezca al usuario autenticado
        $student = Student::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        // Si el estudiante no existe o no pertenece al usuario autenticado, se lanzará un error
        return view('students.uptStudent', compact('student'));
    }


    // Actualizar un estudiante
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:student,email,' . $id,
            'phone' => 'required|digits:8',
            'language' => 'required|string|max:255',
        ]);

        // Buscar el estudiante, asegurándonos de que pertenezca al usuario autenticado
        $student = Student::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        // Actualizar los datos del estudiante
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'language' => $request->language,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('students.show')->with('success', 'Estudiante actualizado correctamente.');
    }


    // public function updatePartial(Request $request, $id)
    // {
    //     $student = Student::find($id);

    //     if (!$student) {
    //         $data = [
    //             'message' => 'Estudiante no encontrado',
    //             'status' => 404
    //         ];
    //         return response()->json($data, 404);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'max:255',
    //         'email' => 'email|unique:student',
    //         'phone' => 'digits:10',
    //         'language' => 'in:English,Spanish,French'
    //     ]);

    //     if ($validator->fails()) {
    //         $data = [
    //             'message' => 'Error en la validación de los datos',
    //             'errors' => $validator->errors(),
    //             'status' => 400
    //         ];
    //         return response()->json($data, 400);
    //     }

    //     if ($request->has('name')) {
    //         $student->name = $request->name;
    //     }

    //     if ($request->has('email')) {
    //         $student->email = $request->email;
    //     }

    //     if ($request->has('phone')) {
    //         $student->phone = $request->phone;
    //     }

    //     if ($request->has('language')) {
    //         $student->language = $request->language;
    //     }

    //     $student->save();

    //     $data = [
    //         'message' => 'Estudiante actualizado',
    //         'student' => $student,
    //         'status' => 200
    //     ];

    //     return response()->json($data, 200);
    // }

}
