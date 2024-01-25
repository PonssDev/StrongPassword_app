addEventListener('DOMContentLoaded', function() {
    // Verificar si hay un parámetro 'registro' en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const registroExitoso = urlParams.get('registro');

    // Mostrar la alerta si el registro fue exitoso
    if (registroExitoso === 'exitoso') {
        alert('Usuario creado correctamente');
    }
})
