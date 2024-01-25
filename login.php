<?php
include "config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $contrasenya = $_POST['contrasenya'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexion, $sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Comprobamos la contraseña
        if($contrasenya === $row['contrasenya']) {
            header('Location: perfil.php');
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    }else{
        echo "Usuario no encontrado";
    }
}