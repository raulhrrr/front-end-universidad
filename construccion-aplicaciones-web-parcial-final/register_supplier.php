<?php

include_once "php/db.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $gender_id = $_POST["gender_id"];
    $document_id = $_POST["document_id"];
    $user = $_POST["user"];
    $password = hash("sha512", $_POST["password"]);
    $repeat_password = hash("sha512", $_POST["repeat_password"]);

    $user_exists = "SELECT * FROM suppliers WHERE user = '$user' OR email = '$email'";
    $result = mysqli_query($dbConnection, $user_exists);

    if ($result && mysqli_num_rows($result) > 0) {
        showAlert('El usuario o el correo ya están registrados en la aplicación');
    } else {
        if ($password !== $repeat_password) {
            showAlert('Las contraseñas son diferentes');
        } else {
            $statement = "INSERT INTO suppliers (name, lastname, address, phone, age, email, gender_id, document_id, `user`, password)
                                    VALUES('$name', '$lastname', '$address', '$phone_number', $age, '$email', $gender_id, $document_id, '$user', '$password')";
            executeStatement($dbConnection, $statement, "./index.php", 'Error al registrar el usuario');
        }
    }
}

include "layouts/header.php";
?>

    <main>

        <div class="py-5 bg-body-tertiary">
            <div class="container">
                <h2>Registro de un nuevo proveedor</h2>
                <form action="register_supplier.php" method="post">
                    <div class="form-group mb-3">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastname">Apellido</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="document_id">Tipo de documento</label>
                        </div>
                        <select class="custom-select form-control" id="document_id" name="document_id" required>
                            <option value="1" selected>CC</option>
                            <option value="2">CE</option>
                            <option value="3">NIT</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_number">Número de celular</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="age">Edad</label>
                        <input type="number" min="18" max="120" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gender_id">Género</label>
                        </div>
                        <select class="custom-select form-control" id="gender_id" name="gender_id" required>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                            <option value="3">Otro</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="user">Nombre de usuario</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="repeat_password">Repita la contraseña</label>
                        <input type="password" class="form-control" id="repeat_password" name="repeat_password"
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>

    </main>

<?php include "layouts/footer.php"; ?>