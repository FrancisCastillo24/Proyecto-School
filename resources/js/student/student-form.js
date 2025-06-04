document.addEventListener("DOMContentLoaded", inicializarEventos, false);

function inicializarEventos() {
    const btn = document.getElementById("btnPrueba");
    if (btn) {
        btn.addEventListener("click", mostrarSaludo, false);
    }
}

function mostrarSaludo() {
    alert('HOLAAA');
}
