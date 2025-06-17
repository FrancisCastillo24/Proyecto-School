document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('studentEditForm'); // cambia id si lo agregas en blade
    const errorDiv = document.createElement('div');
    errorDiv.style.backgroundColor = '#dc3545'; // rojo bootstrap
    errorDiv.style.color = 'white';
    errorDiv.style.padding = '10px';
    errorDiv.style.marginBottom = '15px';
    errorDiv.style.borderRadius = '5px';
    errorDiv.style.display = 'none';

    form.prepend(errorDiv);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        errorDiv.innerHTML = '';
        errorDiv.style.display = 'none';

        let errors = [];

        const userId = form.user_id.value.trim();
        const address = form.address.value.trim();
        const phone = form.phone.value.trim();

        if (!userId) {
            errors.push('Debe seleccionar un usuario.');
        }

        if (!address) {
            errors.push('La dirección es obligatoria.');
        } else if (address.length < 5) {
            errors.push('La dirección debe tener al menos 5 caracteres.');
        } else if (address.length > 255) {
            errors.push('La dirección no puede superar los 255 caracteres.');
        }


        const phoneRegex = /^[67]\d{8}$/;
        if (!phone) {
            errors.push('El teléfono es obligatorio.');
        } else if (!phoneRegex.test(phone)) {
            errors.push('El teléfono debe comenzar con 6 o 7 y tener 9 dígitos.');
        }

        if (errors.length > 0) {
            errorDiv.innerHTML = errors.map(err => `<p>${err}</p>`).join('');
            errorDiv.style.display = 'block';
            return false;
        }

        form.submit();
    });
});
