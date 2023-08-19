<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "formulario_web";
    $port  = "3306";
    $conexion = mysqli_connect($host, $username, $password, $database, $port);

    if (!$conexion) {
        echo "<h1>alert('Error en la conexión')</h1>";
    } else {
        echo "<h1>alert('Conectado exitosamente')</h1>";
    }
