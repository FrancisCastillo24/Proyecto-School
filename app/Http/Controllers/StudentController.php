<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // Aquí validas el rol para que solo ciertos métodos se ejecuten según el rol
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            // Ejemplo: Si la ruta tiene prefijo admin, solo para admins
            if ($request->is('admin/*') && (!$user || !$user->isAdmin())) {
                abort(403, 'Acceso no autorizado para admins');
            }

            // Si la ruta NO tiene prefijo admin, pero es admin, bloquear acceso a estas rutas?
            // O al revés según la lógica que quieras.

            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();

        // if (!$user || !$user->isAdmin()) {
        //     abort(403, 'Acceso no autorizado');
        // }

        $students = Student::all();

        // Contar usuarios sin estudiante
        $usuariosSinEstudiante = User::whereDoesntHave('student')->count();

        return view('admin.student.index', compact('students', 'usuariosSinEstudiante'));
    }



    public function create()
    {
        // Muestro solo los usuarios que aún no tienen un estudiante asignado
        $users = User::whereDoesntHave('student')->get();
        return view('admin.student.create', ['users' => $users]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string',
            // Campos obligatorios solo si NO se seleccionó usuario
            'name' => 'required_without:user_id|string|max:255',
            'email' => 'required_without:user_id|email|unique:users,email',
            'password' => 'required_without:user_id|string|min:6|confirmed',
        ]);

        if ($request->user_id) {
            // Usuario existente
            $user_id = $request->user_id;
        } else {
            // Crear nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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



    public function edit(string $id)
    {
        $user = Auth::user();

        // if (!$user || !$user->isAdmin()) {
        //     abort(403, 'Acceso no autorizado');
        // }

        $student = Student::findOrFail($id);
        $users = User::all();

        return view('admin.student.edit', [
            'student' => $student,
            'users' => $users
        ]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string',
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Estudiante actualizado correctamente');
    }


    public function destroy(string $id)
    {
        //
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.student.index')->with('success', 'Estudiante eliminado correctamente');
    }
}
