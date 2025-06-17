document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('studentForm');
    const errorDiv = document.createElement('div');
    errorDiv.style.color = 'red';
    errorDiv.style.backgroundColor = '#f8d7da';
    errorDiv.style.border = '1px solid #f5c2c7';
    errorDiv.style.padding = '10px';
    errorDiv.style.marginBottom = '15px';
    errorDiv.style.borderRadius = '4px';
    errorDiv.style.display = 'none';

    form.prepend(errorDiv);

    form.addEventListener('submit', (e) => {
        errorDiv.innerHTML = '';
        errorDiv.style.display = 'none';

        const errors = [];

        const userId = document.getElementById('user_id').value;
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirmation').value;
        const address = document.getElementById('address').value.trim();
        const phone = document.getElementById('phone').value.trim();

        // Validar user_id opcional, si está vacío validar usuario nuevo
        if (!userId) {
            // Nombre
            if (!name) {
                errors.push("El nombre es obligatorio cuando no se selecciona usuario existente.");
            } else if (name.length > 255) {
                errors.push("El nombre no puede tener más de 255 caracteres.");
            }

            // Email
            if (!email) {
                errors.push("El correo electrónico es obligatorio cuando no se selecciona usuario existente.");
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                errors.push("El correo electrónico no tiene un formato válido.");
            }

            // Password
            if (!password) {
                errors.push("La contraseña es obligatoria cuando no se selecciona usuario existente.");
            } else if (password.length < 6) {
                errors.push("La contraseña debe tener al menos 6 caracteres.");
            }

            // Confirmar password
            if (password !== passwordConfirm) {
                errors.push("La confirmación de la contraseña no coincide.");
            }
        }

        // Dirección (siempre requerida)
        if (!address) {
            errors.push("La dirección es obligatoria.");
        } else if (address.length < 5) {
            errors.push("La dirección debe tener al menos 5 caracteres.");
        } else if (address.length > 255) {
            errors.push("La dirección no puede tener más de 255 caracteres.");
        }

        // Teléfono (siempre requerido)
        if (!phone) {
            errors.push("El teléfono es obligatorio.");
        } else if (!/^[67]\d{8}$/.test(phone)) {
            errors.push("El teléfono debe contener 9 dígitos y comenzar con 6 o 7.");
        }

        if (errors.length > 0) {
            e.preventDefault();
            errorDiv.innerHTML = '<ul><li>' + errors.join('</li><li>') + '</li></ul>';
            errorDiv.style.display = 'block';
            window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
        }
    });
});
