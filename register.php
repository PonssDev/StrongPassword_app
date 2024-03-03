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
$nombre = $primerApellido = $segundoApellido = $email = "";
$error_message = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $primerApellido = $_POST["primerApellido"];
    $segundoApellido = $_POST["segundoApellido"];
    $email = $_POST["email"];
    $contrasenya = $_POST["contrasenya"];

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email, contrasenya)
                    VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
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
$conn->close();
