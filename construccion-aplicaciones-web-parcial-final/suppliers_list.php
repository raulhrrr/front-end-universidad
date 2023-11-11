<?php

include_once "php/db.php";
include_once "php/role.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    validateAuthAndPageOwner(Role::CLIENT->value);

    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $user_lastname = $_SESSION["user_lastname"];

    $statement = "SELECT u.name, u.lastname, u.phone, u.email, u.id FROM users u INNER JOIN roles r ON r.id = u.role_id WHERE r.name = 'Proveedor'";
    $result = mysqli_query($dbConnection, $statement);
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
                    Los datos del usuario se han actualizado correctamente.
                </div>
            <?php
            }
            ?>

            <h2 class="my-4">Bienvenido <?php echo $user_name . ", " . $user_lastname ?></h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Teléfono</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Productos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        $counter = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo ++$counter ?></th>
                                <td><?php echo $row["name"] . " " . $row["lastname"] ?></td>
                                <td><?php echo $row["phone"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td class="text-center">
                                    <a href="./supplier_info.php?id=<?php echo $row["id"] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" style="color: #008f39;">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php include "layouts/footer.php"; ?>