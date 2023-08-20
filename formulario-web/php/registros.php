<?php

    include "conexion.php";

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $user = $_POST["user"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];
    $age = $_POST["age"];
    $interests = $_POST["interests"];
    $message = $_POST["message"];

    if ($password !== $repeat_password) {
        echo "<script>alert('Las contraseñas son diferentes')</script>";
        header("Location:../index.php");
    }

    $insert_statement = "INSERT INTO datos_usuario (name, lastname, user, password, email, gender, country, age, interests, message) 
                            VALUES ('$name', '$lastname', '$user', '$password', '$email', '$gender', '$country', '$age', '$interests', '$message')";

    $resultado = mysqli_query($conexion, $insert_statement);

    if (!$resultado) {
        echo "<script>alert('Error al registrar usuario')</script>";
        header("Location:../index.php");
    } else {
        echo "<script>alert('Registro exitoso')</script>";
        header("Location:../inicio_sesion.php");
    }

    mysqli_close($conexion);