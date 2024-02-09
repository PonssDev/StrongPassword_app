<?php
// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION["email"])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Conexión a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$username = "edib";
$password = "edib";
$dbname = "strongpassword";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Variables para mantener los datos del formulario
$nombreUsuario = $cuenta = "";
$error_message = "";

// Verificar si se ha enviado el formulario de almacenamiento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $cuenta = $_POST["cuenta"];
    $email = $_SESSION["email"];

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO cuentas (email, nombre_usuario, cuenta)
                    VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $email, $nombreUsuario, $cuenta);

    if ($stmt->execute()) {
        // Almacenamiento exitoso, limpiar los campos
        $nombreUsuario = $cuenta = "";
    } else {
        $error_message = "Error al almacenar la cuenta. Por favor, intenta de nuevo.";
    }

    // Cerrar el statement
    $stmt->close();
}

// Obtener las cuentas del usuario desde la base de datos
$email = $_SESSION["email"];
$selectQuery = "SELECT nombre_usuario, cuenta FROM cuentas WHERE id_usuario = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$cuentas = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            <div class="user-info">
                <p>Bienvenido, <?php echo $_SESSION["email"]; ?></p>
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </header>
        <section class="dashboard__section">
            <div class="wrapper__dashboard">
                <h3 class="dashboard__title">Mis Cuentas</h3>
                <form action="dashboard.php" method="post" class="account-form">
                    <label for="nombreUsuario">Nombre de Usuario:</label>
                    <input type="text" name="nombreUsuario" id="nombreUsuario" required>
                    <label for="cuenta">Cuenta:</label>
                    <input type="text" name="cuenta" id="cuenta" required>
                    <input type="submit" value="Guardar Cuenta">
                </form>
                <?php if (!empty($error_message)) : ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if (!empty($cuentas)) : ?>
                    <ul class="account-list">
                        <?php foreach ($cuentas as $cuenta) : ?>
                            <li><strong><?php echo $cuenta["nombre_usuario"]; ?></strong> - <?php echo $cuenta["cuenta"]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p class="no-accounts-message">No hay cuentas almacenadas.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>
</body>

</html>
