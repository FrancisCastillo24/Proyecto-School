document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('eventForm');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Limpiar estados previos
    clearValidation();

    let isValid = true;

    // Validar nombre: obligatorio y max 50 chars
    const name = form.name.value.trim();
    if (!name) {
      showError(form.name, 'El nombre del evento es obligatorio.');
      isValid = false;
    } else if (name.length > 50) {
      showError(form.name, 'El nombre no puede tener más de 50 caracteres.');
      isValid = false;
    }

    // Validar descripción: obligatorio, min 20 chars
    const description = form.description.value.trim();
    if (!description) {
      showError(form.description, 'La descripción es obligatoria.');
      isValid = false;
    } else if (description.length < 20) {
      showError(form.description, 'La descripción debe tener al menos 20 caracteres.');
      isValid = false;
    }

    // Validar precio: obligatorio, número >= 0
    const price = form.price.value.trim();
    if (price === '') {
      showError(form.price, 'El precio es obligatorio.');
      isValid = false;
    } else if (isNaN(price) || Number(price) < 0) {
      showError(form.price, 'El precio debe ser un número mayor o igual a 0.');
      isValid = false;
    }

    // Validar duración (horas): obligatorio, número >= 1
    const hours = form.hours.value.trim();
    if (hours === '') {
      showError(form.hours, 'La duración es obligatoria.');
      isValid = false;
    } else if (!Number.isInteger(Number(hours)) || Number(hours) < 1) {
      showError(form.hours, 'La duración debe ser un número entero mayor o igual a 1.');
      isValid = false;
    }

    // Validar fecha: obligatorio y no menor a hoy
    const date = form.date.value.trim();
    if (!date) {
      showError(form.date, 'La fecha del evento es obligatoria.');
      isValid = false;
    } else {
      const today = new Date();
      const selectedDate = new Date(date + 'T00:00:00'); // para evitar problema zona horaria
      if (selectedDate < new Date(today.toDateString())) {
        showError(form.date, 'La fecha no puede ser anterior a hoy.');
        isValid = false;
      }
    }

    // Si todo bien, enviar el formulario
    if (isValid) {
      form.submit();
    }
  });

  function showError(input, message) {
    input.classList.add('is-invalid');

    // Busca el div .invalid-feedback, si no existe crea uno
    let feedback = input.nextElementSibling;
    if (!feedback || !feedback.classList.contains('invalid-feedback')) {
      feedback = document.createElement('div');
      feedback.className = 'invalid-feedback';
      input.parentNode.appendChild(feedback);
    }
    feedback.textContent = message;
  }

  function clearValidation() {
    const invalids = form.querySelectorAll('.is-invalid');
    invalids.forEach(el => el.classList.remove('is-invalid'));

    const feedbacks = form.querySelectorAll('.invalid-feedback');
    feedbacks.forEach(fb => {
      // Sólo borra los mensajes de validación generados, 
      // no los que vienen de @error de Blade (si quieres, adapta esto)
      if (!fb.hasAttribute('data-original')) {
        fb.textContent = '';
      }
    });
  }
});
