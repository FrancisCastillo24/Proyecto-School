<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Guardar email en cookie por 7 días si recordarme está activo
        if ($request->has('remember')) {
            Cookie::queue('email', $request->email, 60 * 24 * 7); // 7 días
        } else {
            Cookie::queue(Cookie::forget('email'));
        }

        // La cuenta ha sido rechazada (el campo está en tabla user)
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
