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
    try {
        // Obtén todos los estudiantes
        $students = Student::all();
        
        return view('students.showStudent', compact('students'));
    } catch (\Exception $e) {
        // Manejo de errores
        return response()->json(['error' => 'Error al obtener la lista de estudiantes'], 500);
    }
    }

    public function showCreateForm()
    {
    // Retorna la vista para crear un nuevo estudiante
    return view('students.newStudent');
    }

  // Muestra el formulario de creación de estudiante dentro del modal
   public function modalCreate()
   {
        return view('students.modalCreateStudent');
   }
  
   public function modalUpdate($id)
   {
      $student = Student::findOrFail($id);
      return view('students.modalUpdateStudent', compact('student'));
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
    
        // Si la validación falla, devuelve un error en formato JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en los datos del formulario.',
            ]);
        }
    
        // Crear el estudiante
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'language' => $request->language,
        ]);
    
        // Verificar si la creación fue exitosa
        if ($student) {
            return response()->json([
                'success' => true,
                'message' => 'Estudiante creado correctamente.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema al crear el estudiante.',
            ]);
        }
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
            return redirect()->route('students.show')->with('error', 'Estudiante no encontrado.');
        }
        
        $student->delete();
    
        return redirect()->route('students.show')->with('success', 'Estudiante eliminado correctamente.');
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
