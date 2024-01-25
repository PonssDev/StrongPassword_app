<?php
// Credenciales base de datos
$usuario = "edib";
$contrasena = "edib";
$host = "localhost";
$baseDatos = "usuarios";

// Nos conectamos a la base de datos
$conexion = mysqli_connect($host, $usuario, $contrasena, $baseDatos);

// Comprobamos la conexión
if (!$conexion) {
    die("Error al conectar a la base de datos");
}











