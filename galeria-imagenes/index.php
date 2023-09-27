<?php include "layouts/header.php"; ?>

<main>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php

        require "php/connect.php";

        $statement = "SELECT * FROM cars ORDER BY price";
        $result = mysqli_query($conection, $statement);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($car =  mysqli_fetch_assoc($result)) {
        ?>

            <div class="col">
              <div class="card shadow-sm">
                <img src="img/cars/<?php echo $car['file_name'] ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" />
                <div class="card-body">
                  <strong class="card-text"><?php echo $car['name'] ?></strong>
                  <p class="card-text"><?php echo $car['description'] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-success">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-primary">Comprar</button>
                    </div>
                    <small>$<?php echo $car['price'] ?></small>
                  </div>
                </div>
              </div>
            </div>

        <?php
          }
        }
        ?>

      </div>
      <?php if ($result && mysqli_num_rows($result) === 0) echo "<h2>No hay vehículos que mostrar</h2>"; ?>
    </div>
  </div>

</main>

<?php include "layouts/footer.php"; ?>