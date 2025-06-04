<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::all();
        $user = Auth::user();
        if ($user && $user->isAdmin()) {
            return view('admin.review.index', ['reviews' => $reviews]);
        }

        return view('user.review.index', ['reviews' => $reviews]);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('review.index')->with('error', 'Debes estar registrado para dejar un testimonio.');
        }
        return view('user.review.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'opinion' => 'required|string|min:10|max:1000',  // opinión requerida, texto entre 10 y 1000 caracteres
            'rating'  => 'required|integer|between:1,5',     // valoración requerida, entero entre 1 y 5
        ]);

        Review::create([
            'user_id' => auth::User()->id,  // asignamos el usuario autenticado
            'opinion' => $request->opinion,
            'rating' => $request->rating
        ]);

        return redirect()->route('review.index')->with('success', 'Reseña creado con éxito');
    }


    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        return view('admin.review.edit', ['review' => $review]);
    }


    public function update(Request $request, Review $review)
    {
        // Validación de campos
        $validated = $request->validate([
            'opinion' => 'required|string|min:10|max:1000',  // opinión requerida, texto entre 10 y 1000 caracteres
            'rating'  => 'required|integer|between:1,5',
        ]);

        // Actualizar el testimonio con los datos validados
        $review->update($validated);

        // Redireccionar con mensaje de éxito
        return redirect()->route('review.index')->with('success', 'Testimonio actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Testimonio eliminado correctamente.');
    }
}
