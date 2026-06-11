<?php

session_start();
require_once("conexion.php");

header("Content-Type: application/json");

if(!isset($_SESSION["user_id"])){

    echo json_encode([
        "success" => false,
        "total" => 0
    ]);
    exit;
}

$user_id = intval($_SESSION["user_id"]);

$sql = "
SELECT COALESCE(SUM(amount),0) AS total
FROM points
WHERE user_id = ?
";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

echo json_encode([
    "success" => true,
    "total" => intval($row["total"])
]);