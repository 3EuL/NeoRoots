<?php

require_once("conexion.php");

$sql = "
SELECT
    u.user_id,
    u.user,
    u.pfp,
    COALESCE(SUM(p.amount),0) AS total_points
FROM users u

LEFT JOIN points p
ON u.user_id = p.user_id

WHERE u.rol != 'admin'

GROUP BY
    u.user_id,
    u.user,
    u.pfp

ORDER BY total_points DESC

LIMIT 10
";

$resultado = mysqli_query(
    $conexion,
    $sql
);

$ranking = [];

while($fila = mysqli_fetch_assoc($resultado)){

    $ranking[] = $fila;
}

header("Content-Type: application/json");

echo json_encode($ranking);