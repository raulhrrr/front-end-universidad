<?php

include_once "php/functions.php";

$host = "localhost";
$username = "root";
$password = "password";
$database = "final_web_project";
$port = "3306";

$dbConnection = new mysqli($host, $username, $password, $database, $port);
$dbConnection->set_charset("utf8mb4");

if ($dbConnection->connect_errno) {
    showAlert('Error en la conexión a MySQL: ' . $dbConnection->connect_error);
    exit();
}

function executeStatement($dbConnection, $statement, $redirectTo, $errorMessage, $action = "create", $item = "")
{
    $result = mysqli_query($dbConnection, $statement);
    if ($result) {
        redirect($redirectTo . "?action=$action&success=true" . ($item ? "&item=$item" : ""));
    } else {
        showAlert($errorMessage);
    }
}
