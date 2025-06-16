<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function destroy(User $user)
    {
        // Verificar si el email ya está bloqueado
        $exists = DB::table('blocked_emails')->where('email', $user->email)->exists();

        if (!$exists) {
            DB::table('blocked_emails')->insert([
                'email' => $user->email,
                'created_at' => now(),
            ]);
        }

        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado y su correo ha sido bloqueado.');
    }
}
