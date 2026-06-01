<?php

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

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $ip);
$stmt->execute();

echo "OK";