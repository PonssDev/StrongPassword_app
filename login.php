<?php

include 'config.php';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Variables para mantener los datos del formulario
$email = $contrasenya = "";
$error_message = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasenya = $_POST["contrasenya"];

    // Consultar la base de datos para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE email = ? AND contrasenya = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $email, $contrasenya);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        session_start();

        // Obtener el ID del usuario y almacenarlo en la sesión
        $row = $result->fetch_assoc();
        $_SESSION["id"] = $row["id"];

        $_SESSION["email"] = $email;
        header("Location: dashboard.php"); // Redirigir a la página del panel de control
        exit();
    } else {
        $error_message = "Credenciales incorrectas. Por favor, intenta de nuevo.";
    }

    // Cerrar el statement
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<?php if (!empty($error_message)): ?>
    <p class="error-message">
        <?php echo $error_message; ?>
    </p>
<?php endif; ?>