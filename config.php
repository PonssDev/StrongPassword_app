<?php
// Credenciales base de datos
$usuario = "ddb220748";
$contrasena = "290801snoP";
$host = "bbdd.alandelgadoedib.com";
$baseDatos = "ddb220748";

// Nos conectamos a la base de datos
$conexion = mysqli_connect($host, $usuario, $contrasena, $baseDatos);

// Comprobamos la conexión
if (!$conexion) {
    die("Error al conectar a la base de datos");
}











