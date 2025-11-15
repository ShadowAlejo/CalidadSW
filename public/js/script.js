// public/js/script.js

document.addEventListener('DOMContentLoaded', function () {
    // --- Gestión visual de pestañas (solo interfaz) ---
    const tabs = document.querySelectorAll('.tabs .tab');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            // Quitar clase activa de todas
            tabs.forEach(function (t) {
                t.classList.remove('activa');
            });
            // Activar la pestaña clicada (solo visual)
            this.classList.add('activa');
        });
    });

    // --- Estado "Buscando..." al enviar el formulario ---
    const form = document.querySelector('.form-consulta');
    if (form) {
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function () {
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Buscando...';
            }
        });
    }
});
