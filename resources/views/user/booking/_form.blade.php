<form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre y apellidos</label>
        <input type="text" id="name" name="name" class="form-control" required />
    </div>

    <div class="mb-3">
        <label for="event_id" class="form-label">Selecciona un Evento</label>
        <select id="event_id" name="event_id" class="form-select" required>
            <option value="">-- Elige un evento --</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Personas</label>
        <input type="number" id="quantity" name="quantity" class="form-control" required min="1" />
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="text" id="phone" name="phone" class="form-control" required />
    </div>

    <button type="submit" class="btn btn-primary">Crear Reserva</button>
</form>
