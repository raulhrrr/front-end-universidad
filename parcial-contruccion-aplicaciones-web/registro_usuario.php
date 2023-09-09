<?php include "./layouts/header.php"; ?>

<main class="container mt-5">
    <form action="./php/registros.php" method="post">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="lastname">Apellido:</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
        <div class="form-group">
            <label for="user">Usuario:</label>
            <input type="text" class="form-control" id="user" name="user">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="repeat_password">Confirme la Contraseña:</label>
            <input type="password" class="form-control" id="repeat_password" name="repeat_password">
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="age">Edad:</label>
            <input type="number" class="form-control" id="age" name="age">
        </div>
        <div>
            <div class="joined_elements">
                <div>
                    <input type="submit" value="Registrarse">
                </div>
                <div>
                    <input type="reset" value="Limpiar">
                </div>
            </div>
        </div>
    </form>
</main>
<?php include "./layouts/footer.php" ?>