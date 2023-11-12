<?php

include_once "php/db.php";
include_once "php/role.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    validateAuthAndPageOwner(Role::SHARED->value, false);

    if (!isset($_GET["action"])) {
        redirect("./index.php");
    }

    $action = $_GET["action"];
    $user_id = "";

    if ($action === "update") {
        if (!isset($_GET["id"])) {
            redirect("./index.php");
        }

        $user_id = $_GET["id"];
        $statement = "SELECT name, lastname, document_id, document_number, phone, email, address, age, gender_id, role_id FROM users WHERE id = $user_id";
        $result = mysqli_query($dbConnection, $statement);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
        } else {
            redirect("./index.php");
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST["action"];
    $user_id = $_POST["user_id"];

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $gender_id = $_POST["gender_id"];
    $document_id = $_POST["document_id"];
    $document_number = $_POST["document_number"];
    $role_id = $_POST["role_id"];
    $user = $action === "create" ? $_POST["user"] : "";
    $password = $action === "create" ? hash("sha512", $_POST["password"]) : "";
    $repeat_password = $action === "create" ? hash("sha512", $_POST["repeat_password"]) : "";

    $user_exists = "SELECT * FROM users WHERE user = '$user' OR email = '$email'";
    $result = mysqli_query($dbConnection, $user_exists);

    if ($action === "create" && $result && mysqli_num_rows($result) > 0) {
        showAlert('El usuario o el correo ya están registrados en la aplicación');
    } else {
        if ($password !== $repeat_password) {
            showAlert('Las contraseñas son diferentes');
        } else {
            $statement = $action === "create"
                ? "INSERT INTO users (name, lastname, address, phone, age, email, gender_id, document_id, document_number, role_id, `user`, password) VALUES('$name', '$lastname', '$address', '$phone_number', $age, '$email', $gender_id, $document_id, $document_number, $role_id, '$user', '$password')"
                : "UPDATE users SET name='$name', lastname='$lastname', address='$address', phone='$phone_number', age=$age, email='$email', gender_id=$gender_id, document_id=$document_id, document_number='$document_number' WHERE id = $user_id";

            $redirectTo = "";
            if ($action === "create") {
                $redirectTo = "./index.php";
            } else {
                initSession();
                $role = $_SESSION["user_role"];
                $redirectTo = $role == Role::CLIENT->value ? "./suppliers_list.php" : "./product_inventory.php";

                $_SESSION["user_name"] = $name;
                $_SESSION["user_lastname"] = $lastname;
            }

            executeStatement($dbConnection, $statement, $redirectTo, 'Error al ' . $action === "create" ? "registrar" : "actualizar" . ' el usuario', $action);
        }
    }
}

include "layouts/header.php";
?>

<main>

    <div class="py-5 bg-body-tertiary">
        <div class="container">
            <h2><?php echo $action == "create" ? "Registro de un nuevo usuario" : "Actualización de datos" ?></h2>
            <form action="register_user.php" method="post">
                <input type="hidden" name="action" value="<?php echo $action ?>" />
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $action === "update" ? $user_data["name"] : "" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="lastname">Apellido</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $action === "update" ? $user_data["lastname"] : "" ?>" required>
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="document_id">Tipo de documento</label>
                    </div>
                    <select class="custom-select form-control" id="document_id" name="document_id" required>
                        <option value="1" <?php echo $action === "update" && $user_data["document_id"] == "1" ? "selected" : "" ?>>CC</option>
                        <option value="2" <?php echo $action === "update" && $user_data["document_id"] == "2" ? "selected" : "" ?>>CE</option>
                        <option value="3" <?php echo $action === "update" && $user_data["document_id"] == "3" ? "selected" : "" ?>>NIT</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="document_number">Número de documento</label>
                    <input type="text" class="form-control" id="document_number" name="document_number" value="<?php echo $action === "update" ? $user_data["document_number"] : "" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone_number">Número de celular</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?php echo $action === "update" ? $user_data["phone"] : "" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $action === "update" ? $user_data["email"] : "" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $action === "update" ? $user_data["address"] : "" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="age">Edad</label>
                    <input type="number" min="18" max="120" class="form-control" id="age" name="age" value="<?php echo $action === "update" ? $user_data["age"] : "" ?>" required>
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="gender_id">Género</label>
                    </div>
                    <select class="custom-select form-control" id="gender_id" name="gender_id" required>
                        <option value="1" <?php echo $action === "update" && $user_data["gender_id"] == "1" ? "selected" : "" ?>>Masculino</option>
                        <option value="2" <?php echo $action === "update" && $user_data["gender_id"] == "2" ? "selected" : "" ?>>Femenino</option>
                        <option value="3" <?php echo $action === "update" && $user_data["gender_id"] == "3" ? "selected" : "" ?>>Otro</option>
                    </select>
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="role_id">Tipo de usuario</label>
                    </div>
                    <select class="custom-select form-control" id="role_id" name="role_id" required>
                        <option value="1" <?php echo $action === "update" ? "disabled" : "" ?> <?php echo $action === "update" && $user_data["role_id"] == "1" ? "selected" : "" ?>>Cliente</option>
                        <option value="2" <?php echo $action === "update" ? "disabled" : "" ?> <?php echo $action === "update" && $user_data["role_id"] == "2" ? "selected" : "" ?>>Proveedor</option>
                        <option value="3" disabled>Administrador</option>
                    </select>
                </div>
                <?php if ($action === "create") { ?>
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
                        <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-dark"><?php echo $action === "create" ? "Registrar" : "Actualizar" ?></button>
            </form>
        </div>
    </div>

</main>

<?php include "layouts/footer.php"; ?>