<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Obtenemos los datos del formulario register
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $email = $_POST['email'];
    $contrasenya = $_POST['contrasenya'];

    $sql = "INSERT INTO usuarios (nombre, primerApellido, segundoApellido, email, contrasenya) 
    VALUES ('$nombre', '$primerApellido', '$segundoApellido', '$email', '$contrasenya')";

    if($conexion->query($sql) === TRUE) {
        header('Location: login.html');
        exit();
    } else {
        echo "Error al registrar: ". $conexion->error;
    }
}