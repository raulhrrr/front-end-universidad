<?php

include "conexion.php";

$user_id = $_GET["id"];

$query = "DELETE FROM datos_usuario WHERE id = '$user_id'";
$result = mysqli_query($conexion, $query);

if (!$result) {
    echo "<script>alert('Error al eliminar el usuario')</script>";
} else {
    header("Location:../user_table.php");
}

mysqli_close($conexion);
