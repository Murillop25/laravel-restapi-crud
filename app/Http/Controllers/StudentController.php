<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    // public function index()
    // {
    //     $students = Student::all();
    //     return view('students.show', compact('students'));
    // }
    
    public function showStudent()
    {
        // Obtén todos los estudiantes
        $students = Student::all();
        
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
            'email' => 'required|email|unique:student,email',
            'phone' => 'required|digits:10',
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
        ]);
    
        // Si la creación falla, redirige con un mensaje de error
        if (!$student) {
            return redirect()->route('students.showStudent')->with('error', 'Error al crear el estudiante.');
        }
    
        // Redirige a la vista de estudiantes con un mensaje de éxito
        return redirect()->route('students.showStudent')->with('success', 'Estudiante creado correctamente.');
    }
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
{
    $student = Student::find($id);

    if (!$student) {
        return redirect()->route('students.showStudent')->with('error', 'Estudiante no encontrado.');
    }
    
    $student->delete();

    return redirect()->route('students.showStudent')->with('success', 'Estudiante eliminado correctamente.');
}


    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish,French'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->language = $request->language;

        $student->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|unique:student',
            'phone' => 'digits:10',
            'language' => 'in:English,Spanish,French'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $student->name = $request->name;
        }

        if ($request->has('email')) {
            $student->email = $request->email;
        }

        if ($request->has('phone')) {
            $student->phone = $request->phone;
        }

        if ($request->has('language')) {
            $student->language = $request->language;
        }

        $student->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


}
