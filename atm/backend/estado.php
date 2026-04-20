<?php
include "conexion.php";

$data = json_decode(file_get_contents("php://input"));
$tarjeta = $data->tarjeta;

$sql = "SELECT tipo, monto, detalle, fecha 
        FROM movimientos 
        WHERE tarjeta='$tarjeta'
        ORDER BY fecha DESC";

$result = $conn->query($sql);

$movimientos = [];

while ($row = $result->fetch_assoc()) {
  $movimientos[] = $row;
}

echo json_encode($movimientos);
?>