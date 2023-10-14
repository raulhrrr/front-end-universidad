<?php include "layouts/header.php"; ?>

<main>

	<div class="album py-5 bg-body-tertiary">
		<div class="container">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

				<?php

				include_once "php/connect.php";

				if ($user_autenticated) {

					$statement = "SELECT * FROM cars ORDER BY price";
					$result = mysqli_query($connection, $statement);

					if ($result && mysqli_num_rows($result) > 0) {
						while ($car =  mysqli_fetch_assoc($result)) {
							if ($car["amount"] > 0) {
				?>
								<div class="col">
									<div class="card shadow-sm">
										<img src="img/cars/<?php echo $car['file_name'] ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" />
										<div class="card-body">
											<strong class="card-text"><?php echo $car['name'] ?></strong>
											<p class="card-text"><?php echo $car['description'] ?></p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="btn-group">
													<a class="btn btn-sm btn-outline-success" href="./car_info.php?id=<?php echo $car["id"] ?>">Más información</a>
												</div>
												<div class="d-flex flex-column">
													<?php if ($car["discount"] > 0) { ?>
														<small style="text-decoration: line-through;">$ <?php echo number_format($car['price'], 2) ?></small>
														<div class="d-flex flex-row justify-content-between align-items-center">
															<small class="card-text">$ <?php echo number_format($car['price'] - ($car['price'] * ($car["discount"] / 100)), 2) ?>
																<small class="text-success"><?php echo $car["discount"] ?>% OFF</small>
															</small>
														</div>
													<?php } else { ?>
														<small class="card-text">$ <?php echo number_format($car['price'], 2) ?></small>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>

				<?php
							}
						}
					}

					echo "</div>";
					if ($result && mysqli_num_rows($result) === 0) echo "<h2>No hay vehículos que mostrar</h2>";
				} else {
					echo "</div>";
					echo "<h2>No se encuentra autenticado, por favor inicie sesión</h2>";
				}
				?>

			</div>
		</div>

</main>

<?php include "layouts/footer.php"; ?>