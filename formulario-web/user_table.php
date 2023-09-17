<?php
include "./layouts/header.php";
session_start();
?>

<h1>Bienvenido <?php echo $_SESSION["lastname"] ?>, <?php echo $_SESSION["name"] ?></h1>

<div class="table-responsive d-flex justify-content-center">
    <table class="table table-hover table-striped w-75">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Género</th>
                <th scope="col">País</th>
                <th scope="col">Edad</th>
                <th scope="col">Intereses</th>
                <th scope="col">Mensaje</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="userTable" class="table-group-divider">
            <?php
            include "./php/conexion.php";

            $query = "SELECT * FROM datos_usuario";
            $result = mysqli_query($conexion, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row =  mysqli_fetch_assoc($result)) {
                    echo "<tr scope='row'>";

                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["user"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["country"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["interests"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";
                    
                    echo "<td><a href='./edit_user.php?id=" . $row["id"] . "'>Editar</a></td>";
                    echo "<td><a href='./php/remove_user.php?id=" . $row["id"] . "'>Eliminar</a></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
            }

            mysqli_close($conexion);
            ?>
        </tbody>
    </table>

</div>

<?php include "./layouts/footer.php"; ?>