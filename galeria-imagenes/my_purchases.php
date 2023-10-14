<?php

include_once "php/connect.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    initSession();
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $user_lastname = $_SESSION["user_lastname"];

    $statement = "SELECT o.id, u.name, u.lastname, u.email, o.shipping_address, o.cars_quantity, o.total, o.applied_discount, c.name as car_name, c.description, c.price
                    FROM users u INNER JOIN orders o ON o.user_id = u.id INNER JOIN cars c ON c.id = o.car_id WHERE u.id = $user_id";

    $result = mysqli_query($connection, $statement);

}

include "layouts/header.php";
?>

<main>

    <div class="py-5 bg-body-tertiary">
        <div class="container">
            <h2>Bienvenido <?php echo $user_lastname . ", " . $user_name ?> a tus compras</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Dirección de envío</th>
                        <th scope="col">Nombre del vehículo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio individual (Sin descuento)</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Descuento aplicado</th>
                        <th scope="col">Total compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $row["id"] ?></th>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["shipping_address"] ?></td>
                                <td><?php echo $row["car_name"] ?></td>
                                <td><?php echo $row["description"] ?></td>
                                <td><?php echo number_format($row["price"], 2) ?></td>
                                <td><?php echo $row["cars_quantity"] ?></td>
                                <td><?php echo $row["applied_discount"] . "%" ?></td>
                                <td><?php echo number_format($row["total"], 2) ?></td>
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