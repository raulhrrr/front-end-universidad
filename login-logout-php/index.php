<?php

include_once "php/db.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST["user"];
    $password = hash("sha512", $_POST["password"]);

    $statement = "SELECT * FROM users WHERE user = '$user' AND password = '$password'";
    $result = mysqli_query($dbConnection, $statement);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        initSession();
        $_SESSION["user_id"] = $user_data["id"];
        $_SESSION["user_name"] = $user_data["name"];
        $_SESSION["user_lastname"] = $user_data["lastname"];

        redirect("./status.php");
    } else {
        showAlert("Usuario o contraseña incorrectos");
    }
}

include "layouts/header.php";
?>

<main>

    <div class="py-5 bg-body-tertiary">
        <div class="container">

            <?php
            if (isset($_GET["success"])) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    if (isset($_GET["action"])) {
                        switch ($_GET["action"]) {
                            case "logout":
                                echo "Ha cerrado sesión correctamente.";
                                break;
                            default:
                                echo "El registro se ha realizado con éxito.";
                                break;
                        }
                    }
                    ?>
                </div>
            <?php
            }
            ?>

            <h2>Inicio de sesión</h2>
            <form action="index.php" method="post">
                <div class="form-group mb-3">
                    <label for="user">Usuario</label>
                    <input type="text" class="form-control" id="user" name="user" required />
                </div>
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    <a class="btn btn-primary" href="./register_user.php">Registrarse</a>
                </div>
            </form>
        </div>
    </div>

</main>

<?php include "layouts/footer.php"; ?>