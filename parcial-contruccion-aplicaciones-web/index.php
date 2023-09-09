<?php include "./layouts/header.php" ?>
<main class="container mt-5">
    <form action="./php/inicio.php" method="post">
        <div class="form-group">
            <label for="user">Usuario:</label>
            <input type="text" class="form-control" id="user" name="user">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group d-flex justify-content-end flex-column mb-3 joined_elements">
            <input type="submit" value="Iniciar sesión"></input>
        </div>
    </form>
</main>
<?php include "./layouts/footer.php" ?>