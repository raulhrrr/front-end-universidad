<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Formulario Web</title>
</head>

<body>
    <main>
        <form action="./php/registros.php" method="post">
            <div>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" />
            </div>
            <div>
                <label for="lastname">Apellido:</label>
                <input type="text" id="lastname" name="lastname" />
            </div>
            <div>
                <label for="user">Usuario:</label>
                <input type="text" id="user" name="user" />
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" />
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
                <input type="submit" value="Registrarse">
            </div>
        </form>
    </main>
</body>

</html>