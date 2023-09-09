<?php

include "conexion.php";

$user = $_POST["user"];
$password = hash("sha512", $_POST["password"]);

$query = "SELECT * FROM usuarios WHERE user = '$user' AND password = '$password'";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    header("Location:../listado.php");
} else {
    // header("Location:../index.php");
    echo "<script>alert('Usuario o contraseña incorrectos')</script>";
}

mysqli_close($conexion);
