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
      // Aparece el mensaje justo en el campo
      showError(form.name, 'El nombre del evento es obligatorio.');
      isValid = false;
    } else if (name.length > 50) {
      showError(form.name, 'El nombre no puede tener más de 50 caracteres.');
      isValid = false;
    }

    // Validar descripción
    const description = form.description.value.trim();
    if (!description) {
      showError(form.description, 'La descripción es obligatoria.');
      isValid = false;
    } else if (description.length < 20) {
      showError(form.description, 'La descripción debe tener al menos 20 caracteres.');
      isValid = false;
    }

    // Validar precio
    const price = form.price.value.trim();
    if (price === '') {
      showError(form.price, 'El precio es obligatorio.');
      isValid = false;
    } else if (isNaN(price) || Number(price) < 0) {
      showError(form.price, 'El precio debe ser un número mayor o igual a 0.');
      isValid = false;
    }

    // Validar duración en horas
    const hours = form.hours.value.trim();
    if (hours === '') {
      showError(form.hours, 'La duración es obligatoria.');
      isValid = false;
    } else if (!Number.isInteger(Number(hours)) || Number(hours) < 1) {
      showError(form.hours, 'La duración debe ser un número entero mayor o igual a 1.');
      isValid = false;
    }

    // Validar fecha
    const date = form.date.value.trim();
    if (!date) {
      showError(form.date, 'La fecha del evento es obligatoria.');
      isValid = false;
    } else {
      const today = new Date();
      const selectedDate = new Date(date + 'T00:00:00'); // Da errores de formato, se pone así para evitar problemas de zona horaria
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

    // Busca el div .invalid-feedback, en caso de no existir, pues se crea
    let feedback = input.nextElementSibling;

    // Si no existe ese elemento hermano o si no tiene la clase 'invalid-feedback'
    if (!feedback || !feedback.classList.contains('invalid-feedback')) {

      // Se crea DIV
      feedback = document.createElement('div');

      // Se asgina la clase 'invalid-feedback' para que tenga el estilo adecuado
      feedback.className = 'invalid-feedback';

      // Añadir ese nuevo div como hijo del padre del input (para que aparezca justo después del input)
      input.parentNode.appendChild(feedback);
    }

    // asignar el texto dentro del div, es decir el texto de error
    feedback.textContent = message;
  }

  function clearValidation() {
    // Se busca en el formulario todos los elementos que tienen la clase 'is-invalid' (osea los campos marcados como inválidos)
    const invalids = form.querySelectorAll('.is-invalid');

    // Recorrer cada uno de esos elementos inválidos y quitarles la clase 'is-invalid'
    invalids.forEach(el => el.classList.remove('is-invalid'));

    // Se busca en el formulario todos los elementos que tienen la clase 'invalid-feedback' (mensajes de error)
    const feedbacks = form.querySelectorAll('.invalid-feedback');

    // Recorrer cada mensaje de error
    feedbacks.forEach(fb => {
      // Sólo borra los mensajes de validación generados, 
      if (!fb.hasAttribute('data-original')) {
        fb.textContent = '';
      }
    });
  
  }
});
