<?php

include "conexion.php";

$name = $_POST["name"];
$lastname = $_POST["lastname"];
$user = $_POST["user"];
$password = hash("sha512", $_POST["password"]);
$repeat_password = hash("sha512", $_POST["repeat_password"]);
$email = $_POST["email"];
$gender = $_POST["gender"];
$country = $_POST["country"];
$age = $_POST["age"];
$interests = $_POST["interests"];
$message = $_POST["message"];

$user_exists = "SELECT * FROM datos_usuario WHERE user = '$user' OR email = '$email'";
$result = mysqli_query($conexion, $user_exists);

if ($result && mysqli_num_rows($result) > 0) {
    // header("Location:../registro_usuario.php");
    echo "<script>alert('El usuario o el correo ya están registrados en la aplicación')</script>";
} else {
    if ($password !== $repeat_password) {
        // header("Location:../registro_usuario.php");
        echo "<script>alert('Las contraseñas son diferentes')</script>";
    } else {
        $insert_statement = "INSERT INTO datos_usuario (name, lastname, user, password, email, gender, country, age, interests, message) 
                                VALUES ('$name', '$lastname', '$user', '$password', '$email', '$gender', '$country', '$age', '$interests', '$message')";

        $result = mysqli_query($conexion, $insert_statement);

        if (!$result) {
            // header("Location:../registro_usuario.php");
            echo "<script>alert('Error al registrar usuario')</script>";
        } else {
            // header("Location:../index.php");
            // echo "<script>alert('Registro exitoso')</script>";
        }
    }
}

mysqli_close($conexion);
