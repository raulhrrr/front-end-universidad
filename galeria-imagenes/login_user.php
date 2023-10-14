<?php

include_once "php/connect.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$user = $_POST["user"];
	$password = hash("sha512", $_POST["password"]);

	$query = "SELECT * FROM users WHERE user = '$user' AND password = '$password'";
	$result = mysqli_query($connection, $query);

	if ($result && mysqli_num_rows($result) > 0) {
		$user_data = mysqli_fetch_assoc($result);

		initSession();
		$_SESSION["user_id"] = $user_data["id"];
		$_SESSION["user_name"] = $user_data["name"];
		$_SESSION["user_lastname"] = $user_data["lastname"];

		redirect("./index.php");
	} else {
		showAlert("Usuario o contraseña incorrectos");
	}
}

include "layouts/header.php";
?>

<main>

	<div class="py-5 bg-body-tertiary">
		<div class="container">
			<h2>Inicio de sesión</h2>
			<form action="login_user.php" method="post">
				<div class="form-group mb-3">
					<label for="user">Usuario</label>
					<input type="text" class="form-control" id="user" name="user" required />
				</div>
				<div class="form-group mb-3">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="password" name="password" required />
				</div>
				<button type="submit" class="btn btn-primary">Iniciar sesión</button>
			</form>
		</div>
	</div>

</main>

<?php include "layouts/footer.php"; ?>