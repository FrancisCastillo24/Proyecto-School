document.addEventListener('DOMContentLoaded', () => {
    const btnNewBooking = document.getElementById('btnNewBooking');
    const container = document.getElementById('bookingFormContainer');

    if (!btnNewBooking || !container) return;

    btnNewBooking.addEventListener('click', async (e) => {
        e.preventDefault();

        if (container.innerHTML.trim() !== '') {
            // Si ya está abierto, cerramos el formulario
            container.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(btnNewBooking.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!response.ok) throw new Error('Error al cargar el formulario');

            const html = await response.text();
            container.innerHTML = html;

            // Ahora que el formulario está cargado, añadimos el manejador para envío AJAX
            const form = container.querySelector('form');
            const mensajeDiv = document.createElement('div');
            mensajeDiv.style.color = 'green';
            mensajeDiv.style.marginTop = '10px';
            container.appendChild(mensajeDiv);

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(form);

                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (!res.ok) throw new Error('Error al enviar la reserva');

                    const data = await res.json();
                    mensajeDiv.style.color = 'green';
                    mensajeDiv.textContent = data.message || 'Reserva creada correctamente';
                    form.reset();

                } catch (error) {
                    mensajeDiv.style.color = 'red';
                    mensajeDiv.textContent = error.message || 'Error al enviar la reserva.';
                }
            });


        } catch (error) {
            alert(error.message);
        }
    });
});
