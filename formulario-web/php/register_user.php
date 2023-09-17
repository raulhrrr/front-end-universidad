<?php

include "conexion.php";

$action = $_GET["action"];

if ($action == "create") {
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
        // header("Location:../form_user.php");
        echo "<script>alert('El usuario o el correo ya están registrados en la aplicación')</script>";
    } else {
        if ($password !== $repeat_password) {
            // header("Location:../form_user.php");
            echo "<script>alert('Las contraseñas son diferentes')</script>";
        } else {
            $insert_statement = "INSERT INTO datos_usuario (name, lastname, user, password, email, gender, country, age, interests, message) 
                                    VALUES ('$name', '$lastname', '$user', '$password', '$email', '$gender', '$country', '$age', '$interests', '$message')";

            $result = mysqli_query($conexion, $insert_statement);

            if (!$result) {
                // header("Location:../form_user.php");
                echo "<script>alert('Error al registrar usuario')</script>";
            } else {
                header("Location:../index.php");
                // echo "<script>alert('Registro exitoso')</script>";
            }
        }
    }
} else {
    $user_id = $_GET["user_id"];

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];
    $age = $_POST["age"];
    $interests = $_POST["interests"];
    $message = $_POST["message"];

    $query = "UPDATE datos_usuario SET name='$name', lastname='$lastname', email='$email', gender='$gender', country='$country', age=$age, interests='$interests', message='$message' WHERE id = $user_id";
    $result = mysqli_query($conexion, $query);

    if ($result) {
            header("Location:../user_table.php");
    } else {
        echo "<script>alert('Ha ocurrido un error al editar el usuario')</script>";
    }
}

mysqli_close($conexion);
