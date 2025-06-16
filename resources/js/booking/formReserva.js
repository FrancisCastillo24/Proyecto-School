document.addEventListener('DOMContentLoaded', () => {
    const btnNewBooking = document.getElementById('btnNewBooking');
    const container = document.getElementById('bookingFormContainer');

    if (!btnNewBooking || !container) return;

    // Función de ejemplo para refrescar reservas, debes implementarla
    function refreshBookings() {
        // Aquí podrías hacer fetch para actualizar la lista de reservas
        // o simplemente recargar la página con location.reload()
        console.log('Aquí refrescarías la lista de reservas');
    }

    btnNewBooking.addEventListener('click', async (e) => {
        e.preventDefault();

        // Si el formulario ya está visible, lo cerramos
        if (container.innerHTML.trim() !== '') {
            container.innerHTML = '';
            return;
        }

        // Mostrar spinner mientras carga el formulario
        container.innerHTML = '<div class="spinner">Cargando formulario...</div>';

        try {
            const response = await fetch(btnNewBooking.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (response.status === 401) {
                container.innerHTML = '<div style="color: red; font-weight: bold; margin: 10px 0;">Debes autenticarte para reservar.</div>';
                return;
            }

            if (!response.ok) throw new Error('Error al cargar el formulario');

            const html = await response.text();
            container.innerHTML = html;

            const form = container.querySelector('form');
            const mensajeDiv = document.createElement('div');
            mensajeDiv.style.marginTop = '10px';
            container.appendChild(mensajeDiv);

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const submitBtn = form.querySelector('button[type="submit"]');
                const formData = new FormData(form);

                // Deshabilitar botón y mostrar spinner en botón
                submitBtn.disabled = true;
                const originalBtnText = submitBtn.textContent;
                submitBtn.textContent = 'Enviando...';

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

                    if (!res.ok) {
                        const errorData = await res.json().catch(() => ({}));
                        let msg = 'Error al enviar la reserva.';
                        if (errorData.errors) {
                            msg = Object.values(errorData.errors).flat().join(' ');
                        } else if (errorData.message) {
                            msg = errorData.message;
                        }
                        throw new Error(msg);
                    }

                    const data = await res.json();
                    mensajeDiv.style.color = 'green';
                    mensajeDiv.textContent = data.message || 'Reserva creada correctamente';
                    form.reset();

                    // Aquí llamamos a la función para refrescar reservas
                    refreshBookings();

                } catch (error) {
                    mensajeDiv.style.color = 'red';
                    mensajeDiv.textContent = error.message || 'Error al enviar la reserva.';
                } finally {
                    // Volver a habilitar el botón y quitar el spinner
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
            });

        } catch (error) {
            container.innerHTML = '';
            alert(error.message);
        }
    });
});
