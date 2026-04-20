<?php
include "conexion.php";

$data = json_decode(file_get_contents("php://input"));

$tarjeta = $data->tarjeta;
$pin = $data->pin;

$sql = "SELECT * FROM usuarios WHERE tarjeta='$tarjeta' AND pin='$pin'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>