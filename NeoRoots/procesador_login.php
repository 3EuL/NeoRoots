<?php
session_start();
include("conexion.php");

$login = $_POST['login'];   
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

        if($datos['rol'] == "admin"){

            header("Location: Hub/Hub.php");

        }else{

            header("Location: Hub/Hub.php");

        }

        exit();

        header("Location: ../Page-Reports/Reports.html");
        exit();

    }else{
        echo "Contraseña incorrecta";
    }

}else{
    echo "Usuario o correo no encontrado";
}

if(isset($_POST['noacc'])){
    header("Location: Sign-In/Sign-in.php");
    exit();
}
?>