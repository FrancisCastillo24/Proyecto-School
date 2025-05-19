<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Muestra el listado de estudiantes
        $user = Auth::user();
        $students = Student::all();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Acceso no autorizado');
        }

        return view('admin.student.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Muestro el formulario para crear un estudiante con los datos de usuario
        $users = User::all();
        return view('admin.student.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Almaceno los datos del formulario de estudiante
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|',
        ]);

        Student::create([
        'user_id' => $request->user_id,
        'address' => $request->address,
        'phone' => $request->phone,
        ]);

        return redirect()->route('admin.student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
