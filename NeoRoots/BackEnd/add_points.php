<?php

session_start();

require_once("conexion.php");

header("Content-Type: application/json");

if(!isset($_SESSION["user_id"])){

    echo json_encode([
        "success" => false,
        "error" => "Sesión no iniciada"
    ]);

    exit;
}

$user_id = intval($_SESSION["user_id"]);

$puntos = intval(
    $_POST["points"] ?? 0
);

$container_id = intval(
    $_POST["container_id"] ?? 0
);

$waste_id = intval(
    $_POST["waste_id"] ?? 0
);

if($puntos <= 0){

    echo json_encode([
        "success" => false,
        "error" => "Puntos inválidos"
    ]);

    exit;
}

mysqli_begin_transaction($conexion);

try{

    

    $sql = "
    INSERT INTO points
    (
        amount,
        user_id
    )
    VALUES
    (
        ?,
        ?
    )
    ";

    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $puntos,
        $user_id
    );

    mysqli_stmt_execute($stmt);

    

    $sql = "
    INSERT INTO recycling_log
    (
        user_id,
        container_id,
        waste_id,
        points_earned
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?
    )
    ";

    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iiii",
        $user_id,
        $container_id,
        $waste_id,
        $puntos
    );

    mysqli_stmt_execute($stmt);

    mysqli_commit($conexion);

    echo json_encode([
        "success" => true
    ]);

}catch(Exception $e){

    mysqli_rollback($conexion);

    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}