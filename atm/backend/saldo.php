<?php
include "conexion.php";

$data = json_decode(file_get_contents("php://input"));
$tarjeta = $data->tarjeta;

$sql = "SELECT saldo FROM usuarios WHERE tarjeta='$tarjeta'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

echo json_encode($row);
?>