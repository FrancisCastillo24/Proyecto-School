<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB; // Importante para consulta a blocked_emails
use Illuminate\Validation\ValidationException; // Para lanzar excepción de validación

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Sobrescribe las credenciales para bloquear emails bloqueados
     */
    protected function credentials(Request $request)
    {
        $email = $request->input($this->username());

        // Verifica si el email está bloqueado
        $isBlocked = DB::table('blocked_emails')->where('email', $email)->exists();

        if ($isBlocked) {
            // Lanza una excepción de validación para que el formulario muestre error
            throw ValidationException::withMessages([
                $this->username() => ['Este correo ha sido bloqueado por el administrador.'],
            ]);
        }

        // Si no está bloqueado, retorna las credenciales normales (email y password)
        return $request->only($this->username(), 'password');
    }

    protected function authenticated(Request $request, $user)
    {
        // Guardar email en cookie por 7 días si recordarme está activo
        if ($request->has('remember')) {
            Cookie::queue('email', $request->email, 60 * 24 * 7); // 7 días
        } else {
            Cookie::queue(Cookie::forget('email'));
        }

        // La cuenta ha sido rechazada
        if ($user->is_rejected) {
            Auth::logout();

            return redirect()->route('login')->with('error', 'Tu cuenta fue rechazada. No puedes iniciar sesión.');
        }

        // La cuenta pendiente de aprobación
        if (!$user->is_approved) {
            Auth::logout();

            return redirect()->route('login')->with('error', 'Tu cuenta está pendiente de aprobación por el administrador.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('homeAdmin');
        }

        return redirect()->route('homeUser');
    }
}
