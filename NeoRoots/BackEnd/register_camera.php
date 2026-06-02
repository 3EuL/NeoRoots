<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

$name = $_POST['name'] ?? '';
$ip = $_POST['ip'] ?? '';

if (empty($name) || empty($ip)) {
    http_response_code(400);
    die("Datos incompletos");
}

$sql = "
INSERT INTO cameras (name, ip, status)
VALUES (?, ?, 'online')
ON DUPLICATE KEY UPDATE
    ip = VALUES(ip),
    status = 'online',
    last_seen = CURRENT_TIMESTAMP
";

$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error prepare: " . $conexion->error);
}

$stmt->bind_param("ss", $name, $ip);

if (!$stmt->execute()) {
    die("Error execute: " . $stmt->error);
}

echo "OK";