<?php
session_start();
include("conexion.php");

$login = trim($_POST['login']);   
$pass = trim($_POST['pass']);

if(empty($login) || empty($pass)){
    echo "error_empty";
    exit;
}

$sql = "SELECT * FROM users 
        WHERE user='$login' 
        OR email='$login'";

$resultado = mysqli_query($conexion,$sql);

if(mysqli_num_rows($resultado) > 0){

    $datos = mysqli_fetch_assoc($resultado);

    if(password_verify($pass, $datos['pass'])){

    $_SESSION['user_id'] = $datos['user_id'];
    $_SESSION['user'] = $datos['user'];
    $_SESSION['rol'] = $datos['rol'];

    
    if($datos['rol'] === 'usuario'){
        echo "success_user";
    } else {
        echo "success_admin";
    }

    exit;

    }else{
        echo "error_pass";
    }

}else{
    echo "error_user";
}