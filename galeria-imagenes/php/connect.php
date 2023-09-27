<?php

$host = "localhost";
$username = "root";
$password = "password";
$database = "activities";
$port  = "3306";

$conection = mysqli_connect($host, $username, $password, $database, $port);

if (!$conection) {
    echo "<script>alert('Error en la conexión')</script>";
}
