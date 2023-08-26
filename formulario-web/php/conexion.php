<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "activities";
$port  = "3306";

$conexion = mysqli_connect($host, $username, $password, $database, $port);

if (!$conexion) {
    echo "<script>alert('Error en la conexión')</script>";
}
