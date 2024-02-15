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
$nombreUsuario = $contrasenya = "";
$error_message = "";

// Verificar si se ha enviado el formulario de almacenamiento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasenya = $_POST["contrasenya"];

    // Obtener el ID del usuario actual
    $idUsuario = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $stmt->bind_result($idUsuario);
    $stmt->fetch();
    $stmt->close();

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO savedpass (id_usuario, nombre_usuario, contrasenya) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iss", $idUsuario, $nombreUsuario, $contrasenya);

    if ($stmt->execute()) {
        // Almacenamiento exitoso, limpiar los campos
        $nombreUsuario = $contrasenya = "";

        // Recargar las cuentas después de la inserción
        $selectQuery = "SELECT nombre_usuario, contrasenya FROM savedpass WHERE id_usuario = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $idUsuario);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Obtener todas las filas como un array asociativo
            $cuentas = $result->fetch_all(MYSQLI_ASSOC);
        }
    } else {
        $error_message = "Error al almacenar la cuenta. Por favor, intenta de nuevo.";
        echo "Error al ejecutar la consulta de inserción: " . $stmt->error;
    }


    // Cerrar el statement
    $stmt->close();
}

// Obtener las cuentas del usuario desde la base de datos
$idUsuario = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
$selectQuery = "SELECT nombre_usuario, contrasenya FROM savedpass WHERE id_usuario = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $idUsuario);

// Verificar si la ejecución de la consulta fue exitosa
if ($stmt->execute()) {
    $result = $stmt->get_result();

    // Obtener todas las filas como un array asociativo
    $cuentas = $result->fetch_all(MYSQLI_ASSOC);
}

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
            <a href="index.php">
                <div class="logo">
                    <img src="img/desktop/Strong Password •••_white.webp" alt="" class="logo">
                </div>
            </a>
            <div class="user-info">
                <p>Bienvenido,
                    <?php echo $_SESSION["email"]; ?>
                </p>
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </header>
        <section class="dashboard__section">
            <div class="wrapper__dashboard">
                <h3 class="dashboard__title">Mis Cuentas</h3>
                <form action="dashboard.php" method="post" class="account-form">
                    <label for="nombreUsuario">Nombre de Usuario:</label>
                    <input type="text" name="nombreUsuario" id="nombreUsuario" required>
                    <label for="contrasenya">Contraseña:</label>
                    <input type="password" name="contrasenya" id="contrasenya" required>
                    <input type="submit" value="Guardar Cuenta">
                </form>

                <?php if (!empty($error_message)): ?>
                    <p class="error-message">
                        <?php echo $error_message; ?>
                    </p>
                <?php endif; ?>
                <table class="account-table">
                    <thead>
                        <tr>
                            <th class="">Nombre de Usuario</th>
                            <th>Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($cuentas)) {
                            foreach ($cuentas as $cuenta) {
                                echo "<tr>";
                                echo "<td>" . $cuenta["nombre_usuario"] . "</td>";
                                echo "<td>" . $cuenta["contrasenya"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No hay cuentas almacenadas.</td></tr>";
                        }
                        ?>
                    </tbody>
            </div>
        </section>
    </div>
</body>

</html>