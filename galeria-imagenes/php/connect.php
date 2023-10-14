<?php

include_once "php/functions.php";

$host = "localhost";
$username = "root";
$password = "password";
$database = "activities";
$port  = "3306";

$connection = mysqli_connect($host, $username, $password, $database, $port);

if (!$connection) {
    showAlert('Error en la conexión');
}
