<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
                // Validación personalizada para email rechazado
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->first();
                    if ($user && $user->is_rejected) {
                        $fail('Este correo electrónico fue rechazado y no puede usarse para registrarse.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_approved' => false,
            'is_rejected' => false, // por defecto no rechazado
        ]);
    }

    public function register(Request $request)
    {
        // Verificar si el email está bloqueado (uso DB ya que no es necsario crear un modelo de blocked sino es una consulta rápida)
        $isBlocked = DB::table('blocked_emails')
             // La columna email sea igual al valor que el usuario envió en el formulario 
            ->where('email', $request->input('email'))
            ->exists();

        if ($isBlocked) {
            // Redirigue hacia atrás y aparece un mensaje de error
            return redirect()->back()->withErrors([
                'email' => 'Este correo ha sido bloqueado por el administrador.',
            ])->withInput();
        }

        // Validar datos y registrar
        $this->validator($request->all())->validate();

        // Se crea y guarda el nuevo usuario en la base de datos.
        $user = $this->create($request->all());

        return redirect()->route('login')->with('success', 'Tu cuenta está pendiente de aprobación por el administrador');
    }
}
