<?php
require __DIR__ . "/db.php";
require __DIR__ . "/sesion_start.php";

header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents("php://input"), true);
$email = isset($data["email"]) ? trim($data["email"]) : "";
$password = isset($data["password"]) ? (string)$data["password"] : "";

if ($email === "" || $password === "") {
  http_response_code(400);
  echo json_encode(["ok" => false, "error" => "Faltan datos"]);
  exit;
}

try {
  $stmt = $pdo->prepare("SELECT id, full_name, email, password_hash FROM users WHERE email=? LIMIT 1");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if (!$user || !password_verify($password, $user["password_hash"])) {
    http_response_code(401);
    echo json_encode(["ok" => false, "error" => "Correo o contraseña incorrectos"]);
    exit;
  }

  $_SESSION["user"] = [
    "id" => (int)$user["id"],
    "full_name" => $user["full_name"],
    "email" => $user["email"],
  ];

  echo json_encode(["ok" => true, "user" => $_SESSION["user"]]);
  exit;

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(["ok" => false, "error" => "Error interno en login"]);
  exit;
}