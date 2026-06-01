<?php

include 'conexion.php';

$result = $conexion->query("
    SELECT *
    FROM cameras
    WHERE status='online'
    ORDER BY last_seen DESC
    LIMIT 1
");

header('Content-Type: application/json');

if($row = $result->fetch_assoc()){

    echo json_encode([
        "success" => true,
        "ip" => $row["ip"],
        "url" => "http://" . $row["ip"] . "/capture"
    ]);

}else{

    echo json_encode([
        "success" => false
    ]);

}