<?php

include "./php/conexion.php";
include "./layouts/header.php";

$user_id = $_GET["id"];

$query = "SELECT * FROM datos_usuario WHERE id = '$user_id'";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    header("Location:./user_table.php");
}
?>

<main>
    <form action="./php/register_user.php?action=update&user_id=<?php echo $user_id ?>" method="post">
        <div class="joined_elements">
            <div>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $user["name"] ?>" />
            </div>
            <div>
                <label for="lastname">Apellido:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $user["lastname"] ?>" />
            </div>
        </div>
        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $user["email"] ?>" />
        </div>
        <div>
            <label for="gender">Género:</label>
            <select id="gender" name="gender">
                <option <?php echo "Male" == $user["gender"] ? "selected" : "" ?> value="Male">Masculino</option>
                <option <?php echo "Female" == $user["gender"] ? "selected" : "" ?> value="Female">Femenino</option>
                <option <?php echo "Other" == $user["gender"] ? "selected" : "" ?> value="Other">Otro</option>
            </select>
        </div>
        <div>
            <label for="country">País:</label>
            <input type="text" id="country" name="country" value="<?php echo $user["country"] ?>" />
        </div>
        <div>
            <label for="age">Edad:</label>
            <input type="number" id="age" name="age" value="<?php echo $user["age"] ?>" />
        </div>
        <div>
            <label for="interests">Intereses:</label>
            <input type="text" id="interests" name="interests" value="<?php echo $user["interests"] ?>" />
        </div>
        <div>
            <label for="msg">Mensaje:</label>
            <textarea id="msg" name="message"><?php echo $user["message"] ?></textarea>
        </div>
        <div>
            <div>
                <input type="submit" value="Guardar">
            </div>
        </div>
    </form>
</main>

<?php
include "./layouts/footer.php";
mysqli_close($conexion)
?>