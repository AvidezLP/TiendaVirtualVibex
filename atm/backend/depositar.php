<?php
include "conexion.php";

$data = json_decode(file_get_contents("php://input"));

$tarjeta = $data->tarjeta;
$monto = $data->monto;

$sql = "SELECT saldo FROM usuarios WHERE tarjeta='$tarjeta'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$nuevo = $row["saldo"] + $monto;

$conn->query("UPDATE usuarios SET saldo=$nuevo WHERE tarjeta='$tarjeta'");

// 🔥 GUARDAR MOVIMIENTO (ESTO ESTABA MAL UBICADO)
$conn->query("INSERT INTO movimientos (tarjeta, tipo, monto, detalle)
VALUES ('$tarjeta', 'Deposito', '$monto', '')");

echo json_encode(["success" => true, "saldo" => $nuevo]);
?>