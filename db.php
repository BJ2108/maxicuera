<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_control";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión Fallida: " . $conn->connect_error);
}
?>
