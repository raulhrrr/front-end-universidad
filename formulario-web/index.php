<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Inicio de Sesión</title>
</head>

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
                <input type="submit" value="Iniciar sesión">
            </div>
        </form>
        <a href="./registro_usuario.php">No tiene cuenta? Regístrese</a>
    </main>
</body>

</html>