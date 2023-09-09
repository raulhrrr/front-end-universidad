<?php

include "conexion.php";

$order = $_POST["order"];

$statement = "INSERT INTO ordenes (usuario_id) VALUES(1)";
$result = mysqli_query($conexion, $statement);

if (!$result) {
    // header("Location:../registro_usuario.php");
    echo "<script>alert('Error al registrar la orden')</script>";
} else {
    $statement = "SELECT * FROM ordenes ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conexion, $statement);

    if ($result && mysqli_num_rows($result) > 0) {
        $order_id = mysqli_fetch_assoc($result)["id"];

        foreach ($order as $id) {
            $statement = "INSERT INTO ordenes_platillos (orden_id, platillo_id) VALUES ('$order_id', '$id')";
            $result = mysqli_query($conexion, $statement);
        }
    }
}

mysqli_close($conexion);
