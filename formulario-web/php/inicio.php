<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "conexion.php";

    $user = $_POST["user"];
    $password = $_POST["password"];

    $query = "SELECT * FROM datos_usuario WHERE user = '$user' AND password = '$password'";
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // $user_data = mysqli_fetch_assoc($result);

        // $_SESSION["user_id"] = $user_data["id"];
        // $_SESSION["user_name"] = $user_data["name"];
        // $_SESSION["user_lastname"] = $user_data["lastname"];
        // $_SESSION["user_email"] = $user_data["email"];

        header("Location:../datos_usuario.php");
    } else {
        // header("Location:../index.php");
        echo "<script>alert('Usuario o contraseña incorrectos')</script>";
    }

    mysqli_close($conexion);
}
