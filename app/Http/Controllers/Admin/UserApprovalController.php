<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Si quieres que solo admins puedan acceder, puedes activar esto:
        /*
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) abort(403);
            return $next($request);
        });
        */
    }

    public function pending()
    {
        // Obtener usuarios que no están aprobados
        $users = User::where('is_approved', false)->paginate(5); // 10 usuarios por página
        return view('admin.users.pending', compact('users'));
    }

    public function approve(User $user)
    {
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'Usuario aprobado correctamente.');
    }
}
