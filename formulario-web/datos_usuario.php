<!DOCTYPE html>
<html lang="en">

<?php include "./layouts/header.php"; ?>

<body>
    <h1>Bienvenido!</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Género</th>
            <th>País</th>
            <th>Edad</th>
            <th>Intereses</th>
            <th>Mensaje</th>
        </tr>
        <?php
        // Establecer la conexión a la base de datos
        $conexion = new mysqli("localhost", "usuario", "contraseña", "nombre_base_de_datos");

        // Verificar si la conexión tuvo éxito
        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }

        // Realizar una consulta a la base de datos
        $consulta = "SELECT id, nombre, apellido FROM tabla";
        $resultado = $conexion->query($consulta);

        // Comprobar si hay filas en el resultado
        if ($resultado->num_rows > 0) {
            // Recorrer los resultados y mostrarlos en la tabla
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id"] . "</td>";
                echo "<td>" . $fila["nombre"] . "</td>";
                echo "<td>" . $fila["apellido"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </table>
</body>

</html>
