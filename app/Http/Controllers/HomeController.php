<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('homeUser');
    }

    // Privilegios para acceder al panel administrador
    public function homeAdmin()
    {
        $user = auth::User();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Acceso no autorizado');
        }

        return view('homeAdmin');
    }
}
