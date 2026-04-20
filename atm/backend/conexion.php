<?php
$conn = new mysqli("localhost", "root", "", "atm");

if ($conn->connect_error) {
    die("Error de conexión");
}
?>