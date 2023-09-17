<?php

include "conexion.php";

$user = $_POST["user"];
$password = hash("sha512", $_POST["password"]);

$query = "SELECT * FROM datos_usuario WHERE user = '$user' AND password = '$password'";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);

    session_start();

    $_SESSION["id"] = $user_data["id"];
    $_SESSION["name"] = $user_data["name"];
    $_SESSION["lastname"] = $user_data["lastname"];

    header("Location:../user_table.php");
} else {
    // header("Location:../index.php");
    echo "<script>alert('Usuario o contraseña incorrectos')</script>";
}

mysqli_close($conexion);
