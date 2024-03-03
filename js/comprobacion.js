// Espera a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Obtiene referencias a elementos del formulario
    const form = document.getElementById("register");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("contrasenya");

    // Agrega un event listener para el envío del formulario
    form.addEventListener("submit", function (event) {
        // Validar que el campo de correo contenga un correo electrónico
        if (!isValidEmail(emailInput.value)) {
            alert("Por favor, ingrese un correo electrónico válido.");
            event.preventDefault(); // Evitar el envío del formulario si la validación falla
            return;
        }

        // Validar que la contraseña tenga al menos 8 caracteres
        if (passwordInput.value.length < 8) {
            alert("La contraseña debe tener al menos 8 caracteres.");
            event.preventDefault(); // Evitar el envío del formulario si la validación falla
        }
    });

    // Función para validar un correo electrónico simple
    function isValidEmail(email) {
        // Utilizamos una expresión regular simple para verificar el formato del correo electrónico
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
