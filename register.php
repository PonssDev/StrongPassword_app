<?php
// Conexión a la base de datos (reemplaza con tus propios datos)
include 'config.php';

// Variables para mantener los datos del formulario
$error_message = "";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST["nombre"];
    $primerApellido = $_POST["primerApellido"];
    $segundoApellido = $_POST["segundoApellido"];
    $email = $_POST["email"];
    $contrasenya = $_POST["contrasenya"];

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email, contrasenya)
                    VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($insertQuery);
    $stmt->bind_param("sssss", $nombre, $primerApellido, $segundoApellido, $email, $contrasenya);

    if ($stmt->execute()) {
        // Redirigir a la página de inicio de sesión después de un registro exitoso
        header("Location: login.html");
        exit(); // Importante para evitar que se siga ejecutando el resto del código
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    // Cerrar el statement
    $stmt->close();
}

// Cerrar la conexión


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    </head>

    <body>
        <div id="container">
            <header>
                <div class="logo">
                    <img src="img/desktop/Strong Password •••_white.webp" alt="" class="logo">
                </div>
            </header>
            <section class="register__section">
                <div class="wrapper__register">
                    <form action="register.php" id="register" method="post">
                        <h3 class="registrate__tittle">Regístrate</h3>
                        <!-- Agrega un mensaje de error -->
                        <?php if (!empty($error_message)) : ?>
                        <p class="error-message">
                            <?php echo $error_message; ?>
                        </p>
                        <?php endif; ?>
                        <input type="text" placeholder="Nombre" name="nombre" id="nombre">
                        <input type="text" placeholder="Primer apellido" name="primerApellido" id="primerApellido">
                        <input type="text" placeholder="Segundo apellido" name="segundoApellido" id="segundoApellido">
                        <input type="email" placeholder="Email" name="email" id="email">
                        <input type="password" placeholder="Contraseña" name="contrasenya" id="contrasenya">
                        <input type="submit" value="Regístrarse" id="registrate">
                    </form>
                </div>
            </section>
        </div>
        <script src="js/comprobacion.js"></script>
    </body>
</html>
<?php
$conexion->close();
?>
