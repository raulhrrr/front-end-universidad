<?php

include_once "php/connect.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$name = $_POST["name"];
	$lastname = $_POST["lastname"];
	$document_id = $_POST["document_id"];
	$phone_number = $_POST["phone_number"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$age = $_POST["age"];
	$gender_id = $_POST["gender_id"];
	$country = $_POST["country"];
	$user = $_POST["user"];
	$password = hash("sha512", $_POST["password"]);
	$repeat_password = hash("sha512", $_POST["repeat_password"]);

	$user_exists = "SELECT * FROM users WHERE user = '$user' OR email = '$email'";
	$result = mysqli_query($connection, $user_exists);

	if ($result && mysqli_num_rows($result) > 0) {
		showAlert('El usuario o el correo ya están registrados en la aplicación');
	} else {
		if ($password !== $repeat_password) {
			showAlert('Las contraseñas son diferentes');
		} else {
			$insert_statement = "INSERT INTO users (name, lastname, document_id, phone_number, email, address, age, gender_id, country, user, password)
									VALUES('$name', '$lastname', $document_id, $phone_number, '$email', '$address', $age, $gender_id, '$country', '$user', '$password')";

			$result = mysqli_query($connection, $insert_statement);

			if (!$result) {
				showAlert('Error al registrar usuario');
			} else {
				redirect("./login_user.php?success=true");
			}
		}
	}
}

include "layouts/header.php";
?>

<main>

	<div class="py-5 bg-body-tertiary">
		<div class="container">
			<h2>Registro de un nuevo usuario</h2>
			<form action="register_user.php" method="post">
				<div class="form-group mb-3">
					<label for="name">Nombre</label>
					<input type="text" class="form-control" id="name" name="name" required>
				</div>
				<div class="form-group mb-3">
					<label for="lastname">Apellido</label>
					<input type="text" class="form-control" id="lastname" name="lastname" required>
				</div>
				<div class="form-group input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="document_id">Tipo de documento</label>
					</div>
					<select class="custom-select form-control" id="document_id" name="document_id" required>
						<option value="1" selected>CC</option>
						<option value="2">CE</option>
						<option value="3">NIT</option>
					</select>
				</div>
				<div class="form-group mb-3">
					<label for="phone_number">Número de celular</label>
					<input type="number" class="form-control" id="phone_number" name="phone_number" required>
				</div>
				<div class="form-group mb-3">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" required>
				</div>
				<div class="form-group mb-3">
					<label for="address">Dirección</label>
					<input type="text" class="form-control" id="address" name="address" required>
				</div>
				<div class="form-group mb-3">
					<label for="age">Edad</label>
					<input type="number" min="18" max="120" class="form-control" id="age" name="age" required>
				</div>
				<div class="form-group input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="gender_id">Género</label>
					</div>
					<select class="custom-select form-control" id="gender_id" name="gender_id" required>
						<option value="1">Masculino</option>
						<option value="2">Femenino</option>
						<option value="3">Otro</option>
					</select>
				</div>
				<div class="form-group mb-3">
					<label for="country">País</label>
					<input type="text" class="form-control" id="country" name="country" required>
				</div>
				<div class="form-group mb-3">
					<label for="user">Nombre de usuario</label>
					<input type="text" class="form-control" id="user" name="user" required>
				</div>
				<div class="form-group mb-3">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<div class="form-group mb-3">
					<label for="repeat_password">Repita la contraseña</label>
					<input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
				</div>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		</div>
	</div>

</main>

<?php include "layouts/footer.php"; ?>