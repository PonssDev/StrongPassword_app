<?php
// Iniciar sesión
session_start();

// Cerrar la sesión
session_unset();
session_destroy();

// Redirigir a la página de inicio
header("Location: index.php");
exit();
