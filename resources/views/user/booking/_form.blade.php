<form method="POST" action="{{ route('booking.store') }}" class="p-4 shadow rounded bg-white">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Tu nombre completo" required>
    </div>

    <div class="mb-3">
        <label for="event_id" class="form-label">Evento</label>
        <select name="event_id" id="event_id" class="form-select" required>
            <option value="">-- Selecciona un evento --</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Cantidad de personas</label>
        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="phone" name="phone" minlength="9" maxlength="9" placeholder="Ej. 612345678">
    </div>

    <button type="submit" class="btn btn-primary w-100">Reservar</button>
</form>
