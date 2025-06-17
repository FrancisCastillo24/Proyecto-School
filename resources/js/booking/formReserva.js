document.addEventListener('DOMContentLoaded', () => {

    // botón para crear una nueva reserva
    const btnNewBooking = document.getElementById('btnNewBooking');

    // Aqui es el contenedor donde se cargará el formulario de reserva
    const container = document.getElementById('bookingFormContainer');

    // Si no existe el botón o el contenedor, salimos para evitar errores
    if (!btnNewBooking || !container) return;

    // Función para refrescar la lista de reservas después de crear una nueva
    function refreshBookings() {
        console.log('Aquí refrescarías la lista de reservas');
    }

    // Escuchamos el click en el botón para crear nueva reserva
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
            /**
             * 
             * Hacemos una petición AJAX (fetch) a la URL que tiene el botón btnNewBooking en su atributo href
             * Esto es para obtener el formulario de nueva reserva sin recargar la página
             * El header 'X-Requested-With': 'XMLHttpRequest' le indica al servidor que es una petición AJAX,
             * así el servidor puede responder con solo el blade necesario (sin la plantilla completa, por ejemplo)
             */
            const response = await fetch(btnNewBooking.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            // Si la respuesta es 401, significa que el usuario no está autenticado
            if (response.status === 401) {
                container.innerHTML = '<div style="color: red; font-weight: bold; margin: 10px 0;">Debes autenticarte para reservar.</div>';
                return;
            }

            // Si la respuesta no es exitosa, lanzamos error
            if (!response.ok) throw new Error('Error al cargar el formulario');

             // Obtenemos el blade del formulario y lo insertamos en el contenedor
            const html = await response.text();
            container.innerHTML = html;

            // Buscamos el formulario dentro del contenedor para agregar la lógica de envío
            const form = container.querySelector('form');

            // Creamos un div para mostrar mensajes al usuario (éxito o error)
            const mensajeDiv = document.createElement('div');
            mensajeDiv.style.marginTop = '10px';
            container.appendChild(mensajeDiv);

            // Escuchamos el envío del formulario para enviarlo en AJAX
            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const submitBtn = form.querySelector('button[type="submit"]');
                const formData = new FormData(form);

                // Deshabilitamos el botón y cambiamos el texto para indicar envío
                submitBtn.disabled = true;
                const originalBtnText = submitBtn.textContent;
                submitBtn.textContent = 'Enviando...';

                try {
                    // Enviamos el formulario por POST con los encabezados necesarios
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    // Si la respuesta no es exitosa, obtenemos el error y lanzamos excepción
                    if (!res.ok) {
                        // Intentamos obtener el cuerpo de la respuesta en formato JSON, si falla devolvemos un objeto vacío
                        const errorData = await res.json().catch(() => ({}));

                        // Mensaje de error
                        let msg = 'Error al enviar la reserva.';

                        // Si la respuesta JSON tiene un objeto "errors" (normalmente validaciones)
                        if (errorData.errors) {
                            // Convertimos los errores a un array plano y los unimos en un solo string para mostrar
                            msg = Object.values(errorData.errors).flat().join(' ');

                            // Si no hay "errors" pero sí un mensaje general, lo usamos
                        } else if (errorData.message) {
                            msg = errorData.message;
                        }

                        // Lanzamos un error con el mensaje para que se capture en el bloque catch y mostrarlo
                        throw new Error(msg);
                    }

                    // Si todo va bien, mostramos mensaje de éxito y limpiamos el formulario
                    const data = await res.json();
                    mensajeDiv.style.color = 'green';
                    mensajeDiv.textContent = data.message || 'Reserva creada correctamente';
                    form.reset();

                    // Aquí llamamos a la función para refrescar reservas
                    refreshBookings();

                } catch (error) {
                    // En caso de error, mostramos mensaje en rojo
                    mensajeDiv.style.color = 'red';
                    mensajeDiv.textContent = error.message || 'Error al enviar la reserva.';
                } finally {
                    // Volver a habilitar el botón y quitar el spinner (el spinner es el elemento visual que se usa para indicar que algo está cargando o en proceso)
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
            });

        } catch (error) {
              // Si falla la carga del formulario, limpiamos el contenedor y mostramos alerta
            container.innerHTML = '';
            alert(error.message);
        }
    });
});
