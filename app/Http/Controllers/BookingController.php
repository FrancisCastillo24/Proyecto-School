<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Compruebo si es admin o usuario y muestro sus vistas
        $user = Auth::user();
        $bookings = Booking::all();

        if ($user && $user->isAdmin()) {
            return view('admin.booking.index', ['bookings' => $bookings]);
        }

        return view('user.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax()) {
            $events = Event::all(['id', 'name']);
            return view('user.booking._form', ['events' => $events]); // Formulario parcial para ajax
        }

        return redirect()->route('booking.index'); // Redirige al listado si no es ajax
    }



    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    Booking::create([
        'user_id'  => Auth::check() ? Auth::id() : null,
        'phone'    => $request->phone,
        'quantity' => $request->quantity,
        'name'     => $request->name,
        'event_id' => $request->event_id,
    ]);

    if ($request->ajax()) {
        return response()->json([
            'message' => 'Reserva creada con éxito'
        ]);
    }

    return redirect()->route('booking.index')->with('success', 'Reserva creada con éxito');
}







    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // El usuario modifica la reserva realizada
        $booking = Booking::findOrFail($id);
        return view('user.booking.index', ['booking' => $booking]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Actualizamos los datos nuevos
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'quantity'    => 'required|integer|min:1',
            'name'        => 'required|string|max:100',
        ]);

        // Actualizar el testimonio con los datos validados
        $booking->update($validated);

        // Redireccionar con mensaje de éxito
        return redirect()->route('booking.index')->with('success', 'Reserva actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Eliminamos una única reserva
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Reserva eliminado correctamente.');
    }
}
