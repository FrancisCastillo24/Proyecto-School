document.addEventListener('DOMContentLoaded', () => {
    // Cuando la página ya cargó todo...

    // Buscamos el select donde el usuario puede elegir un usuario existente
    const userSelect = document.getElementById('user_id');

    // Buscamos el contenedor con los campos para crear un nuevo usuario
    const newUserFields = document.getElementById('newUserFields');

    function toggleNewUserFields() {
        // Habilita o deshabilita los campos para crear un usuario nuevo
        const inputs = newUserFields.querySelectorAll('input');
        if (userSelect.value !== "") {

            // Cuando el select tenga un usuario elegido
            inputs.forEach(input => {
                input.disabled = true; // Deshabilitamos esos inputs
                input.required = false; // Y ya no son obligatorios
            });
        } else {
             // Si no hay usuario seleccionado
            inputs.forEach(input => {
                input.disabled = false; // Habilitamos los inputs
                input.required = true; // Y los hacemos obligatorios
            });
        }
    }

    // Cada vez que cambie el select, llamamos a la función para actualizar los inputs
    userSelect.addEventListener('change', toggleNewUserFields);

    // Justo después de cargar la página, llamamos a esa función una vez para que el formulario esté en el estado correcto sin que el usuario tenga que hacer nada.
    toggleNewUserFields(); 
});
