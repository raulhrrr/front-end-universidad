<?php

include_once "php/db.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET["action"])) {
        if ($_GET["action"] === "delete" && !isset($_GET["success"])) {
            $product_id = $_GET["id"];
            $statement = "DELETE FROM products WHERE id = $product_id";
            executeStatement($dbConnection, $statement, "./product_inventory.php", "Error al eliminar el producto", "delete");
        }
    }

    initSession();
    $supplier_id = $_SESSION["supplier_id"];
    $supplier_name = $_SESSION["supplier_name"];
    $supplier_lastname = $_SESSION["supplier_lastname"];

    $statement = "SELECT * FROM products WHERE supplier_id = $supplier_id";
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
                        <?php
                        if (isset($_GET["action"])) {
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
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>

                <h2 class="my-4">Bienvenido <?php echo $supplier_name . ", " . $supplier_lastname ?></h2>

                <div class="my-4">
                    <a class="btn btn-sm btn-outline-success" href="./add_product.php?action=create">Añadir nuevo producto</a>
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
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
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo number_format($row["price"], 2) ?></td>
                                <td><?php echo $row["quantity"] ?></td>
                                <td>
                                    <a href="./add_product.php?action=update&id=<?php echo $row["id"] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="./product_inventory.php?action=delete&id=<?php echo $row["id"] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
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