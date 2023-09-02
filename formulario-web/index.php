<!DOCTYPE html>
<html lang="en">

<?php include "./layouts/header.php"; ?>

<body>
    <main>
        <form action="./php/inicio.php" method="post">
            <div>
                <label for="user">Usuario:</label>
                <input type="text" id="user" name="user" />
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" />
            </div>
            <div>
                <a href="./registro_usuario.php">¿No tiene cuenta? Regístrese</a>
                <input type="submit" value="Iniciar sesión">
            </div>
        </form>
    </main>
</body>

</html>