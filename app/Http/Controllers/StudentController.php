<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function create()
    {
        $users = User::whereDoesntHave('student')->get();
        return view('admin.student.create', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'name' => 'required_without:user_id|string|max:255',
            'email' => 'required_without:user_id|email|unique:users,email',
            'password' => 'required_without:user_id|string|min:6|confirmed',
        ]);

        if ($request->filled('user_id')) {
            $user_id = $request->user_id;

            // Nos aseguramos que el usuario tenga el rol y esté aprobado también (es opcional)
            $user = User::find($user_id);
            $user->update([
                'role' => 'student',
                'is_approved' => true,
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'is_approved' => true,
            ]);
            $user_id = $user->id;
        }

        Student::create([
            'user_id' => $user_id,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Estudiante registrado correctamente');
    }


    public function index()
    {
        $students = Student::all();
        // Buscamos con where aquellos que no son estudiante
        $usuariosSinEstudiante = User::whereDoesntHave('student')->count();
        return view('admin.student.index', compact('students', 'usuariosSinEstudiante'));
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $users = User::all();
        return view('admin.student.edit', compact('student', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^[67]\d{8}$/'], // teléfono válido
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $request->user_id,
        ]);

        $student = Student::findOrFail($id);

        // Actualiza usuario relacionado con el user_id
        $user = User::find($request->user_id);
        if ($user) {
            if ($request->filled('name')) {
                $user->name = $request->name;
            }
            if ($request->filled('email')) {
                $user->email = $request->email;
            }
            $user->save();
        }

        // Actualiza datos del estudiante
        $student->update([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Estudiante actualizado correctamente');
    }


    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('admin.student.index')->with('success', 'Estudiante eliminado correctamente');
    }
}
