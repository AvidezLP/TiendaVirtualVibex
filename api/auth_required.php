<?php
require __DIR__ . "/sesion_start.php";

if (empty($_SESSION["user"])) {
  header("Location: /vibex/index.html");
  exit;
}