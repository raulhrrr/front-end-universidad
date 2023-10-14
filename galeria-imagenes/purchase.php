<?php

include_once "php/connect.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    initSession();
    $user_id = $_SESSION["user_id"];
    $car_id = $_GET["car_id"];
    $cars_quantity = $_GET["cars_quantity"];

    $statement = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($connection, $statement);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
    } else {
        redirect("./login_user.php");
    }

    $statement = "SELECT * FROM cars WHERE id = $car_id";
    $result = mysqli_query($connection, $statement);

    if ($result && mysqli_num_rows($result) > 0) {
        $car_data = mysqli_fetch_assoc($result);
    } else {
        redirect("./index.php");
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_POST["user_id"];
    $car_id = $_POST["car_id"];
    $contact_number = $_POST["contact_number"];
    $shipping_address = $_POST["shipping_address"];
    $cars_quantity = $_POST["cars_quantity"];
    $total = floatval(str_replace(",", "", $_POST["total"]));
    $applied_discount = intval(str_replace("%", "", $_POST["applied_discount"]));
    $earned_ballots = intval(floor($total / 50000));

    $statement = "INSERT INTO orders (user_id, car_id, contact_number, shipping_address, cars_quantity, total, applied_discount, earned_ballots, datetime)
                    VALUES($user_id, $car_id, $contact_number, '$shipping_address', $cars_quantity, $total, $applied_discount, $earned_ballots, CURRENT_TIMESTAMP)";

    $result = mysqli_query($connection, $statement);

    if (!$result) {
        showAlert('Error al registrar la orden de compra');
    } else {
        $statement = "SELECT amount FROM cars WHERE id = $car_id";
        $result = mysqli_query($connection, $statement);

        $previousAmount = mysqli_fetch_assoc($result)["amount"];

        $newAmount = $previousAmount - $cars_quantity;

        $statement = "UPDATE cars SET amount = $newAmount WHERE id = $car_id";
        $result = mysqli_query($connection, $statement);

        redirect("./my_purchases.php?earned_ballots=$earned_ballots");
    }
}

include "layouts/header.php";
?>

<main>

    <div class="py-5 bg-body-tertiary">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Datos de facturación</h2>
                <strong>** Recibirás una boleta por cada 50,000.00</strong>
            </div>
            <form action="purchase.php" method="post">
                <input type="hidden" type="number" name="user_id" value="<?php echo $user_id ?>">
                <input type="hidden" type="number" name="car_id" value="<?php echo $car_id ?>">
                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input type="" class="form-control" id="name" value="<?php echo $user_data["name"] ?>" readonly required>
                </div>
                <div class="form-group mb-3">
                    <label for="lastname">Apellido</label>
                    <input type="text" class="form-control" id="lastname" value="<?php echo $user_data["lastname"] ?>" readonly required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" value="<?php echo $user_data["email"] ?>" readonly required>
                </div>
                <div class="form-group mb-3">
                    <label for="contact_number">Número de contacto</label>
                    <input type="number" class="form-control" id="contact_number" name="contact_number" value="<?php echo $user_data["phone_number"] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="shipping_address">Dirección de envío</label>
                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="<?php echo $user_data["address"] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="product">Producto elegido</label>
                    <input type="text" class="form-control" id="product" value="<?php echo "Nombre: " . $car_data["name"] . " | Precio individual: " . number_format($car_data["price"], 2); ?>" readonly required>
                </div>
                <div class="form-group mb-3">
                    <label for="cars_quantity">Cantidad de vehículos</label>
                    <input type="number" class="form-control" id="cars_quantity" name="cars_quantity" value="<?php echo $cars_quantity ?>" readonly required>
                </div>
                <div class="form-group mb-3">
                    <label for="total">Total</label>
                    <input type="text" class="form-control" id="total" name="total" value="<?php
                                                                                            $price = $car_data["discount"] > 0 ? $car_data['price'] - ($car_data['price'] * ($car_data["discount"] / 100)) : $car_data["price"];
                                                                                            $price = $price * $cars_quantity;
                                                                                            echo $car_data["discount"] > 0 ? number_format($price, 2) : number_format($price, 2);
                                                                                            ?>" readonly required>
                </div>
                <div class="form-group mb-3">
                    <label for="applied_discount">Descuento aplicado</label>
                    <input type="text" class="form-control" id="applied_discount" name="applied_discount" value="<?php echo "" . $car_data["discount"] . "%" ?>" readonly required>
                </div>
                <button type="submit" class="btn btn-primary">Realizar pedido</button>
            </form>
        </div>
    </div>

</main>

<?php include "layouts/footer.php"; ?>