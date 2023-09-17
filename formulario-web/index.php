<?php include "./layouts/header.php"; ?>

<main>
    <form action="./php/login.php" method="post">
        <div>
            <label for="user">Usuario:</label>
            <input type="text" id="user" name="user" />
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" />
        </div>
        <div>
            <a href="./form_user.php">¿No tiene cuenta? Regístrese</a>
            <input type="submit" value="Iniciar sesión">
        </div>
    </form>
</main>

<?php include "./layouts/footer.php"; ?>