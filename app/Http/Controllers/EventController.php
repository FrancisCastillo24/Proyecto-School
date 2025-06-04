<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $events = Event::all();

        if ($user && $user->isAdmin()) {
            return view('admin.event.index', ['events' => $events]);
        }

        return view('user.event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de campos
        $campos = [
            'name' => 'required|string|max:50',
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'hours' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
        ];

        $mensajes = [
            'required' => 'El campo :attribute está vacío',
            'description.min' => 'La descripción debe tener al menos 20 caracteres',
            'price.numeric' => 'El precio debe ser un número',
            'hours.integer' => 'Las horas deben ser un número entero',
            'date.after_or_equal' => 'La fecha debe ser igual o posterior a hoy',
        ];

        $this->validate($request, $campos, $mensajes);

        // Obtener datos del formulario, excepto el token
        $datosEvento = request()->except('_token');

        // Insertar en base de datos
        Event::insert($datosEvento);

        return redirect()->route('admin.event.index')->with('mensaje', 'Evento agregado con éxito');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', ['event' => $event]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Validación de campos
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'hours' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // Actualizar el evento con los datos validados
        $event->update($validated);

        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.event.index')->with('success', 'Evento actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminar el evento
        $event = Event::findOrFail($id);
        $event->delete();

        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.event.index')->with('success', 'Evento eliminado exitosamente.');
    }
}
