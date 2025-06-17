<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Listar reservas según el rol
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->isAdmin()) {
            // event porque está relacionado con un evento
            $bookings = Booking::with('event')->paginate(5);
            return view('admin.booking.index', compact('bookings'));
        }

        $bookings = Booking::with('event')->where('user_id', $user->id)->paginate(5);
        return view('user.booking.index', compact('bookings'));
    }

    // Mostrar formulario para crear reserva
    public function create(Request $request)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Debes autenticarte para reservar'], 401);
            }
            return redirect()->route('login')->withErrors('Debes iniciar sesión para reservar.');
        }

        $events = Event::all(['id', 'name']);

        /**
         * 
         * Si la petición se hizo por AJAX (sin recargar la página)
         * Se devuelve una respuesta en formato JSON con un mensaje y los datos de la reserva (con el evento incluido).
         * 
         */
        if ($request->ajax()) {
            // Devuelve solo el fragmento para insertar vía JS
            return view('user.booking._form', compact('events'));
        }

        // Vista completa para petición normal
        return view('user.booking.create', compact('events'));
    }

    // Guardar reserva (soporte AJAX y peticiones normales)
    public function store(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:100',
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
            'phone'    => [
                'required',
                'regex:/^[6-7]\d{8}$/',
            ],
        ];

        $validated = $request->validate($rules);

        $booking = Booking::create([
            'user_id'  => Auth::id(),
            'name'     => $validated['name'],
            'event_id' => $validated['event_id'],
            'quantity' => $validated['quantity'],
            'phone'    => $validated['phone'],
        ]);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Reserva creada con éxito',
                'booking' => $booking->load('event'),
            ]);
        }

        return redirect()->route('booking.index')->with('success', 'Reserva creada con éxito');
    }


    // Mostrar formulario para editar reserva
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);

        // Opcional: validar que el usuario puede editar (propio o admin)
        $this->authorize('update', $booking);

        return view('user.booking.edit', compact('booking'));
    }

    // Actualizar reserva
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $rules = [
            'name'     => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'phone'    => 'required|string|max:20',
        ];

        $validated = $request->validate($rules);

        $booking->update($validated);

        return redirect()->route('booking.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    // Eliminar reserva
    public function destroy(Booking $booking)
    {
        /*
        * Por si alguien intenta hacer la acción directamente (por ejemplo, enviando la URL para borrar), Laravel también bloquea la acción 
        * porque el authorize no permitirá que continúe si no eres admin.
        */
        $this->authorize('delete', $booking);

        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
