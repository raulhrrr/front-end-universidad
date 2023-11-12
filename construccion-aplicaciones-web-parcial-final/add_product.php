<?php

include_once "php/db.php";
include_once "php/role.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    validateAuthAndPageOwner(Role::SUPPLIER->value);

    if (!isset($_GET["action"])) {
        redirect("./product_inventory.php");
    }

    $action = $_GET["action"];
    $product_id = "";

    if ($action === "update") {
        if (!isset($_GET["id"])) {
            redirect("./product_inventory.php");
        }

        $product_id = $_GET["id"];
        $statement = "SELECT name, price, quantity FROM products WHERE id = $product_id";
        $result = mysqli_query($dbConnection, $statement);

        if ($result && mysqli_num_rows($result) > 0) {
            $product_data = mysqli_fetch_assoc($result);
        } else {
            redirect("./product_inventory.php");
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    initSession();
    $supplier_id = $_SESSION["user_id"];
    $action = $_POST["action"];
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $statement = $action === "create"
        ? "INSERT INTO products (supplier_id, name, price, quantity) VALUES($supplier_id, '$name', $price, $quantity)"
        : "UPDATE products SET name = '$name', price = $price, quantity = $quantity WHERE id = $product_id";
    executeStatement($dbConnection, $statement, "./product_inventory.php", 'Error al registrar el producto', $action, "product");
}

include "layouts/header.php";
?>

<main>

    <div class="py-5 bg-body-tertiary">
        <div class="container">
            <h2><?php echo $action === "create" ? "Registro de un nuevo producto" : "Actualización del producto" ?></h2>
            <form action="add_product.php" method="post">
                <input type="hidden" name="action" value="<?php echo $action ?>" />
                <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
                <div class="form-group mb-3">
                    <label for="name">Nombre del producto</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del producto" value="<?php echo $action === "update" ? $product_data["name"] : "" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Precio unitario</label>
                    <input type="number" class="form-control" min="0" id="price" name="price" placeholder="Ingrese el precio precio unitario del producto" value="<?php echo $action === "update" ? $product_data["price"] : "0" ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Cantidad</label>
                    <input type="number" oninput="this.value = Math.round(this.value);" min="0" class="form-control" id="quantity" name="quantity" placeholder="Ingrese la cantidad de productos disponibles" value="<?php echo $action === "update" ? $product_data["quantity"] : "1" ?>" required>
                </div>
                <button type="submit" class="btn btn-dark"><?php echo $action === "create" ? "Añadir" : "Actualizar" ?></button>
            </form>
        </div>
    </div>

</main>

<?php include "layouts/footer.php"; ?>