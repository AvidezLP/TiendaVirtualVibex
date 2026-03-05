<?php
require __DIR__ . "/db.php";

header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents("php://input"), true);
$full_name = isset($data["full_name"]) ? trim($data["full_name"]) : "";
$email = isset($data["email"]) ? trim($data["email"]) : "";
$password = isset($data["password"]) ? (string)$data["password"] : "";

if ($full_name === "" || $email === "" || $password === "") {
  http_response_code(400);
  echo json_encode(["ok" => false, "error" => "Completa todos los campos"]);
  exit;
}

if (strlen($password) < 6) {
  http_response_code(400);
  echo json_encode(["ok" => false, "error" => "La contraseña debe tener mínimo 6 caracteres"]);
  exit;
}

try {
  // ¿ya existe?
  $check = $pdo->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
  $check->execute([$email]);
  if ($check->fetch()) {
    http_response_code(409);
    echo json_encode(["ok" => false, "error" => "Ese correo ya está registrado"]);
    exit;
  }

  $hash = password_hash($password, PASSWORD_BCRYPT);

  $ins = $pdo->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
  $ins->execute([$full_name, $email, $hash]);

  echo json_encode(["ok" => true]);
  exit;

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(["ok" => false, "error" => "Error interno en registro"]);
  exit;
}