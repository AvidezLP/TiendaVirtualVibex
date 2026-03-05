<?php
require __DIR__ . "/session_start.php";
header('Content-Type: application/json; charset=utf-8');

if (empty($_SESSION["user"])) {
  echo json_encode(["ok" => false]);
  exit;
}

echo json_encode(["ok" => true, "user" => $_SESSION["user"]]);