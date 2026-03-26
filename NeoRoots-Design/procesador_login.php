<?php
session_start();
include("conexion.php");

$login = $_POST['login'];   // aquí se escribe usuario o email
$pass = $_POST['pass'];

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

        header("Location: ../Page-Reports/Reports.html");
        exit();

    }else{
        echo "Contraseña incorrecta";
    }

}else{
    echo "Usuario o correo no encontrado";
}
?>