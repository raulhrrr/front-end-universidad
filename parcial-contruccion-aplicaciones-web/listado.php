<?php include "./layouts/header2.php" ?>

<main>
    <section>
        <h2>Nuestros platillos</h2>
        <div class="gallery">
            <?php
            include "./php/conexion.php";

            $statement = "SELECT * FROM platillos";
            $result = mysqli_query($conexion, $statement);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row =  mysqli_fetch_assoc($result)) {
                    echo "<div class='card' style='width: 15rem;'>";
                    echo "<img src='" . $row["path"] . "' class='card-img-top' alt='" . $row["name"] . "'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row["name"] . " <strong>$" . $row["price"] . "</strong></h5>";
                    echo "<p class='card-text'>" . $row["description"] . "</p>";
                    echo "<button onclick='agregarPlatillo(" . $row["id"] . ")' class='btn btn-primary'>Añadir</button>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
            }
            ?>
        </div>
        <div class="d-flex justify-content-between mt-5">
            <button id="order" onclick="enviarInformacion()" href="#" class="btn btn-success" disabled>Realizar pedido</button>
            <label>Número de pedidos añadidos: <strong id="counter">0</strong></label>
        </div>
    </section>
</main>

<script>
    let order = []

    const cambiarEstadoBoton = (bool) => {
        let btnPedido = document.getElementById("order")
        btnPedido.disabled = bool
    }

    const cambiarContador = (length) => {
        let counter = document.getElementById("counter")
        counter.innerHTML = length
    }

    const agregarPlatillo = (id) => {
        order.push(Number.parseInt(id))

        if (order.length > 0) {
            cambiarEstadoBoton(false)
        }

        cambiarContador(order.length)
    }

    const enviarInformacion = () => {
        $.ajax({
            type: "POST",
            url: "./php/registrar_pedido.php",
            data: {
                order
            },
            success: function(res) {
                order = []
                cambiarEstadoBoton(true)
                cambiarContador(order.length)
                alert("Se ha registrado el pedido")
            }
        });
    }
</script>

<?php include "./layouts/footer.php" ?>