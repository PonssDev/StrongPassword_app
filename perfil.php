<?php
include "config.php";
session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header('Location: login.html');
    exit();
}

// Obtener información del usuario desde la base de datos (esto es solo un ejemplo)
include 'config.php';

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM usuarios WHERE id = $usuario_id";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    // Manejar el caso en el que el usuario no se encuentra en la base de datos
    echo 'Error: Usuario no encontrado';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Puedes incluir enlaces a tus estilos adicionales aquí -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        #container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .logo img {
            max-width: 100%;
        }

        /* Estilos específicos para perfil.php */
        .perfil__section {
            margin-top: 20px;
        }

        .wrapper__perfil {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
        }

        h1 {
            color: #333;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #fff;
            background-color: #333;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div id="container">
        <header>
            <div class="logo">
                <img src="img/desktop/Strong Password •••_white.webp" alt="" class="logo">
            </div>
        </header>

        <section class="perfil__section">
            <div class="wrapper__perfil">
                <h1>Bienvenido a tu perfil,
                    <?php echo $usuario['nombre']; ?>
                </h1>

                <!-- Mostrar más información del perfil según sea necesario -->

                <a href="logout.php">Cerrar sesión</a> <!-- Enlace para cerrar sesión -->
            </div>
        </section>
    </div>
</body>

</html>