const CURSOS = [
    { id: 1, nombre: "Primaria", descripcion: "Cursos diseñados para desarrollar habilidades básicas en matemáticas, lectura y ciencias para niños de 6 a 12 años." },
    { id: 2, nombre: "ESO", descripcion: "Programa completo para estudiantes de Educación Secundaria Obligatoria, abarcando asignaturas como matemáticas, ciencias, historia y lengua." },
    { id: 3, nombre: "Bachillerato", descripcion: "Preparación avanzada para estudios universitarios, con énfasis en ciencias, humanidades y artes." },
    { id: 4, nombre: "Inglés B1", descripcion: "Curso intermedio de inglés que cubre comprensión oral, escrita y expresión para comunicarse en situaciones cotidianas." },
    { id: 5, nombre: "Inglés B2", descripcion: "Curso avanzado de inglés que desarrolla fluidez, vocabulario y comprensión para entornos académicos y profesionales." }
];

window.addEventListener("load", () => {
    const btnMostrarCursos = document.getElementById("btnMostrarCursos");
    if (btnMostrarCursos) {
        btnMostrarCursos.addEventListener("click", toggleCursos);
    }
});

function toggleCursos() {
    const contenedor = document.getElementById("contenedorTabla");
    const tablaExistente = document.getElementById("tablaCursos");
    const btnMostrarCursos = document.getElementById("btnMostrarCursos");

    if (tablaExistente) {
        contenedor.removeChild(tablaExistente);
        btnMostrarCursos.textContent = "Mostrar Cursos";
    } else {
        const tabla = document.createElement("table");
        tabla.id = "tablaCursos";
        tabla.className = "table table-bordered table-hover table-striped";

        const thead = document.createElement("thead");
        thead.classList.add("table-light");
        const headerRow = document.createElement("tr");

        ["Curso", "Descripción"].forEach(texto => {
            const th = document.createElement("th");
            th.textContent = texto;
            headerRow.appendChild(th);
        });

        thead.appendChild(headerRow);
        tabla.appendChild(thead);

        const tbody = document.createElement("tbody");

        CURSOS.forEach(curso => {
            const fila = document.createElement("tr");

            const tdNombre = document.createElement("td");
            tdNombre.textContent = curso.nombre;

            const tdDescripcion = document.createElement("td");
            tdDescripcion.textContent = curso.descripcion;

            fila.appendChild(tdNombre);
            fila.appendChild(tdDescripcion);
            tbody.appendChild(fila);
        });

        tabla.appendChild(tbody);
        contenedor.appendChild(tabla);

        btnMostrarCursos.textContent = "Ocultar Cursos";
    }
}
