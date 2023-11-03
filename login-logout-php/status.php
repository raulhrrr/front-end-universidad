<?php

include_once "php/db.php";
include_once "php/functions.php";
include "layouts/header.php";

if (!$user_authenticated) {
    redirect("./index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    initSession();
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $user_lastname = $_SESSION["user_lastname"];
}

?>

    <main>

        <div class="py-5 bg-body-tertiary">
            <div class="container">

                <h2 class="my-4">Bienvenido <?php echo $user_name . ", " . $user_lastname ?>. Se encuentra autenticado</h2>

            </div>
        </div>

    </main>

<?php include "layouts/footer.php"; ?>