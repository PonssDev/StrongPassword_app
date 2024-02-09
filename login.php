<?php
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
$email = $contrasenya = "";
$error_message = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasenya = $_POST["contrasenya"];

    // Consultar la base de datos para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE email = ? AND contrasenya = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $contrasenya);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        session_start();
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