<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['user_id'])){
    echo "error:Sesión no válida";
    exit();
}

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id='$id'";
$resultado = mysqli_query($conexion,$sql);
$usuario = mysqli_fetch_assoc($resultado);

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $confirm = $_POST['confirm_pass'] ?? '';

    $pfp_name = $usuario['pfp'];

    /* SUBIR IMAGEN */
    if(isset($_FILES['pfp']) && $_FILES['pfp']['error'] == 0){

        $pfp_name = time() . "_" . $_FILES['pfp']['name'];

        move_uploaded_file(
            $_FILES['pfp']['tmp_name'],
            "Images/" . $pfp_name
        );
    }

    /* VALIDACIÓN CONTRASEÑA */
    if(!empty($pass)){

        if(empty($confirm)){
            echo "error:Debes confirmar la contraseña";
            exit();
        }

        if($pass !== $confirm){
            echo "error:Las contraseñas no coinciden";
            exit();
        }
    }

    /* ACTUALIZAR */
    if(!empty($pass)){

        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        $update = "UPDATE users 
        SET user='$user', email='$email', pass='$pass_hash', pfp='$pfp_name'
        WHERE user_id='$id'";

    }else{

        $update = "UPDATE users 
        SET user='$user', email='$email', pfp='$pfp_name'
        WHERE user_id='$id'";
    }

    if(mysqli_query($conexion,$update)){
        echo "ok";
    }else{
        echo "error:No se pudo guardar";
    }

    exit();
}