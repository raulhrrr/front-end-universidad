<?php
include "layouts/header.php";

include_once "php/connect.php";
include_once "php/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$id = $_GET["id"];

	$statement = "SELECT * FROM cars WHERE id = $id";
	$result = mysqli_query($connection, $statement);

	if (mysqli_num_rows($result) === 0) {
		redirect("./index.php");
	}

	$car = mysqli_fetch_assoc($result);

	if ($car["amount"] <= 0) {
		redirect("./index.php");
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST["id"];
	$amount = $_POST["amount"];

	redirect("./purchase.php", "?car_id=$id&cars_quantity=$amount");
}

?>

<main>
	<div class="container py-5">
		<div class="row">
			<div class="col-md-6 order-md-1">
				<div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="img/cars/<?php echo $car['file_name'] ?>" class="d-block w-100">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<div class="col-md-6 order-md-2">
				<div class="card-body">
					<strong class="card-text"><?php echo $car['name'] ?></strong>
					<p class="card-text"><?php echo $car['description'] ?></p>
					<div class="d-flex flex-column justify-content-between">
						<div class="d-flex flex-column">
							<?php if ($car["discount"] > 0) { ?>
								<small style="text-decoration: line-through">$ <?php echo number_format($car['price'], 2) ?></small>
								<div class="d-flex flex-row justify-content-between align-items-center">
									<small class="card-text">$ <?php echo number_format($car['price'] - ($car['price'] * ($car["discount"] / 100)), 2) ?>
										<small class="text-success"><?php echo $car["discount"] ?>% OFF</small>
									</small>
								</div>
							<?php } else { ?>
								<small class="card-text">$ <?php echo number_format($car['price'], 2) ?></small>
							<?php } ?>
						</div>
						<hr>
						<form action="./car_info.php" method="post">
							<input type="hidden" type="number" name="id" value="<?php echo $car["id"] ?>">
							<div class="form-group">
								<label for="amount">Cantidad disponible: <?php echo $car["amount"] ?></label>
								<br>
								<input id="amount" class="w-100" type="number" name="amount" value="1" min="1" max="<?php echo $car["amount"] ?>" onkeydown="return false">
							</div>
							<div class="form-group">
								<div class="btn-group-vertical w-100 py-3" role="group">
									<input type="submit" class="btn btn-sm btn-primary my-2" value="Comprar ahora" />
									<button type="button" class="btn btn-sm btn-outline-primary" disabled>Agregar al carrito</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include "layouts/footer.php"; ?>