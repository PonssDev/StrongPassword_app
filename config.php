<?php
// Credenciales base de datos
$usuario = "ddb220754";
$contrasena = "Rg[qjDqlxJtU_8";
$host = "bbdd.alandelgadoedib.com";
$baseDatos = "ddb220754";

// Nos conectamos a la base de datos
$conexion = mysqli_connect($host, $usuario, $contrasena);
$condb = mysqli_select_db($conexion, $baseDatos);