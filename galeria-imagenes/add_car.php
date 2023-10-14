<?php

include_once "php/connect.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$name = $_POST["name"];
	$description = $_POST["description"];
	$price = $_POST["price"];
	$discount = $_POST["discount"];
	$amount = $_POST["amount"];
	$file = $_FILES["file"];

	$images_folder = 'img/cars/';

	if (!is_dir($images_folder)) {
		mkdir($images_folder);
	}

	$image_name = md5(uniqid(rand(), true)) . ".jpg";
	move_uploaded_file($file['tmp_name'], $images_folder . $image_name);

	$statement = "INSERT INTO cars (name, description, price, discount, amount, file_name) VALUES ('$name', '$description', $price, $discount, $amount, '$image_name')";
	$result = mysqli_query($connection, $statement);

	redirect("./index.php?success=true");
}

include "layouts/header.php";
?>

<main>

	<div class="py-5 bg-body-tertiary">
		<div class="container">
			<h2>Registro de un nuevo vehículo</h2>
			<form action="add_car.php" method="post" enctype="multipart/form-data">
				<div class="form-group mb-3">
					<label for="name">Nombre del vehículo</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del vehículo" required>
				</div>
				<div class="form-group mb-3">
					<label for="description">Descripción del vehículo</label>
					<input type="text" class="form-control" id="description" name="description" placeholder="Ingrese la descripción del vehículo" required>
				</div>
				<div class="form-group mb-3">
					<label for="price">Precio del vehículo</label>
					<input type="number" class="form-control" id="price" name="price" placeholder="Ingrese el precio del vehículo" required>
				</div>
				<div class="form-group mb-3">
					<label for="discount">Descuento (Opcional)</label>
					<input type="number" oninput="this.value = Math.round(this.value);" class="form-control" id="discount" name="discount" placeholder="Ingrese el descuento del vehículo (Si aplica)">
				</div>
				<div class="form-group mb-3">
					<label for="amount">Cantidad</label>
					<input type="number" oninput="this.value = Math.round(this.value);" min="0" class="form-control" id="amount" name="amount" placeholder="Ingrese la cantidad de vehículos disponibles" required>
				</div>
				<div class="form-group mb-3">
					<label for="file">Imagen</label>
					<input type="file" accept="image/jpeg, image/png" class="form-control-file" id="file" name="file" required>
				</div>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		</div>
	</div>

</main>

<?php include "layouts/footer.php"; ?>