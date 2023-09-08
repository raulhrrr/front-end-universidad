<!DOCTYPE html>
<html lang="en">

<?php include "./layouts/header.php"; ?>

<body>
    <main>
        <form action="./php/registros.php" method="post">
            <div class="joined_elements">
                <div class="joined_element">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" />
                </div>
                <div class="joined_element">
                    <label for="lastname">Apellido:</label>
                    <input type="text" id="lastname" name="lastname" />
                </div>
            </div>
            <div>
                <label for="user">Usuario:</label>
                <input type="text" id="user" name="user" />
            </div>
            <div class="joined_elements">
                <div class="joined_element">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" />
                </div>
                <div class="joined_element">
                    <label for="repeat_password">Confirme la Contraseña:</label>
                    <input type="password" id="repeat_password" name="repeat_password" />
                </div>
            </div>
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" />
            </div>
            <div>
                <label for="gender">Género:</label>
                <select id="gender" name="gender">
                    <option value="Male">Masculino</option>
                    <option value="Female">Femenino</option>
                    <option value="Other">Otro</option>
                </select>
            </div>
            <div>
                <label for="country">País:</label>
                <input type="text" id="country" name="country" />
            </div>
            <div>
                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" />
            </div>
            <div>
                <label for="interests">Intereses:</label>
                <input type="text" id="interests" name="interests" />
            </div>
            <div>
                <label for="msg">Mensaje:</label>
                <textarea id="msg" name="message"></textarea>
            </div>
            <div>
                <a href="./index.php">¿Ya tiene cuenta? Inicie sesión</a>
                <div class="joined_elements">
                    <div class="joined_element">
                        <input type="submit" value="Registrarse">
                    </div>
                    <div class="joined_element">
                        <input type="reset" value="Limpiar">
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>

</html>