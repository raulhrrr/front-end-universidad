<?php

$connection = mysqli_connect("localhost", "root", "password", "public_services", "3306");
mysqli_set_charset($connection, "utf8");

if (!$connection) {
    echo '<script>
       alert("Error en la conexión a la base de datos");
       </script>';
}

$statement = "SELECT name FROM months";
$result = mysqli_query($connection, $statement);
$labels = mysqli_fetch_all($result);

$statement = "SELECT monthly_consumption_kwh FROM energy_consumption WHERE `year` = '2021' ORDER BY date_id";
$result = mysqli_query($connection, $statement);
$consumptions_2021 = mysqli_fetch_all($result);

$statement = "SELECT monthly_consumption_kwh FROM energy_consumption WHERE `year` = '2022' ORDER BY date_id";
$result = mysqli_query($connection, $statement);
$consumptions_2022 = mysqli_fetch_all($result);

?>


<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highcharts Example</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#container').highcharts({
                title: {
                    text: 'Datos de energía',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Sistema BD de energía by Raúl Herrera',
                    x: -20
                },
                xAxis: {
                    categories: [
                        <?php
                        foreach ($labels as $label) {
                        ?> '<?php echo $label[0] ?>',
                        <?php } ?>
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Consumo mes medido en kWh'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#db1818'
                    }]
                },
                tooltip: {
                    valueSuffix: ' kWh'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                        name: 'Consumo de energía 2021',
                        data: [
                            <?php
                            foreach ($consumptions_2021 as $consumption) {
                            ?>
                                <?php echo $consumption[0] ?>,
                            <?php
                            }
                            ?>
                        ]
                    },
                    {
                        name: 'Consumo de energía 2022',
                        data: [
                            <?php
                            foreach ($consumptions_2022 as $consumption) {
                            ?>
                                <?php echo $consumption[0] ?>,
                            <?php
                            }
                            ?>
                        ]
                    }
                ]
            });
        });
    </script>
</head>

<body>
    <script src="./highcharts.js"></script>
    <script src="./exporting.js"></script>

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

</body>

</html>