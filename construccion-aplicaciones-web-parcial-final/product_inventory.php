<?php

include_once "php/db.php";
include_once "php/role.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!isset($_GET["action"])) {
        validateAuthAndPageOwner(Role::SUPPLIER->value);
    }

    $viewOnly = false;
    if (isset($_GET["action"])) {
        if ($_GET["action"] !== "viewOnly") {
            validateAuthAndPageOwner(Role::SUPPLIER->value);

            if ($_GET["action"] === "delete" && !isset($_GET["success"])) {
                $product_id = $_GET["id"];
                $statement = "DELETE FROM products WHERE id = $product_id";
                executeStatement($dbConnection, $statement, "./product_inventory.php", "Error al eliminar el producto", "delete", "product");
            }
        } else {
            $viewOnly = true;
        }
    }

    initSession();
    $supplier_id = !$viewOnly ? $_SESSION["user_id"] : $_GET["id"];
    $supplier_name = !$viewOnly ? $_SESSION["user_name"] : $_GET["supplier_name"];
    $supplier_lastname = !$viewOnly ? $_SESSION["user_lastname"] : $_GET["supplier_lastname"];

    $statement = "SELECT id, name, price, quantity FROM products WHERE supplier_id = $supplier_id";
    $result = mysqli_query($dbConnection, $statement);
}

include "layouts/header.php";
?>

<main>

    <div class="py-5 bg-body-tertiary">
        <div class="container">

            <?php
            if (isset($_GET["success"]) && !$viewOnly) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    if (isset($_GET["action"])) {
                        if (isset($_GET["item"])) {
                            switch ($_GET["action"]) {
                                case "delete":
                                    echo "El producto se ha eliminado correctamente.";
                                    break;
                                case "update":
                                    echo "El producto se ha actualizado correctamente.";
                                    break;
                                default:
                                    echo "El producto se ha añadido correctamente.";
                                    break;
                            }
                        } else {
                            echo "Los datos del usuario se han actualizado correctamente.";
                        }
                    }
                    ?>
                </div>
            <?php
            }
            ?>

            <?php if ($viewOnly) { ?>
                <h2 class="my-4">Productos del proveedor <?php echo $supplier_name . " " . $supplier_lastname ?> </h2>
            <?php } else { ?>
                <h2 class="my-4">Bienvenido, <?php echo $supplier_name . " " . $supplier_lastname ?></h2>

                <div class="my-4">
                    <a class="btn btn-sm btn-outline-success" href="./add_product.php?action=create">Añadir nuevo producto</a>
                </div>
            <?php } ?>

            <input class="form-control" id="filterInput" type="text" placeholder="Filtrar">
            <br>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Precio Unitario</th>
                        <th class="text-center" scope="col">Cantidad</th>
                        <?php if ($viewOnly) { ?>
                            <th class="text-center" scope="col">Añadir</th>
                        <?php } else { ?>
                            <th class="text-center" scope="col">Editar</th>
                            <th class="text-center" scope="col">Eliminar</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        $counter = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo ++$counter ?></th>
                                <td><?php echo $row["name"] ?></td>
                                <td class="text-end"><?php echo number_format($row["price"], 2) ?></td>
                                <td class="text-end"><?php echo $row["quantity"] ?></td>
                                <?php if ($viewOnly) { ?>
                                    <td class="text-center">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16" style="color: #008f39;">
                                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
                                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center">
                                        <a href="./add_product.php?action=update&id=<?php echo $row["id"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" style="color: #008f39;">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="./product_inventory.php?action=delete&id=<?php echo $row["id"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: #cb3234;">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#filterInput").on("keyup", function() {
                const value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</main>

<?php include "layouts/footer.php"; ?>