<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['user_id'])){
    header("Location: Log-In/Login.php");
    exit();
}

$id = $_POST['user_id'];
$user = $_POST['user'];
$email = $_POST['email'];

$pass = $_POST['pass'] ?? '';
$confirm = $_POST['confirm_pass'] ?? '';


if(!empty($pass)){

    if(empty($confirm)){
        echo "error:Debes confirmar la contraseña";
        exit;
    }

    if($pass !== $confirm){
        echo "error:Las contraseñas no coinciden";
        exit;
    }

    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET 
            user='$user',
            email='$email',
            pass='$passHash'
            WHERE user_id='$id'";

}else{

    $sql = "UPDATE users SET 
            user='$user',
            email='$email'
            WHERE user_id='$id'";
}


if(!mysqli_query($conexion, $sql)){
    echo "error:" . mysqli_error($conexion);
    exit;
}


if(isset($_FILES['pfp']) && $_FILES['pfp']['error'] == 0){

    
    $check = getimagesize($_FILES['pfp']['tmp_name']);
    if($check === false){
        echo "error:El archivo no es una imagen válida";
        exit;
    }

    
    if($_FILES['pfp']['size'] > 2000000){
        echo "error:La imagen es muy grande (max 2MB)";
        exit;
    }

    
    $sqlOld = "SELECT pfp FROM users WHERE user_id='$id'";
    $result = mysqli_query($conexion, $sqlOld);
    $row = mysqli_fetch_assoc($result);

    $rutaImagen = __DIR__ . "/ASSETS/ProfilePictures/" . $row['pfp'];

    if($row['pfp'] && file_exists($rutaImagen)){
        unlink($rutaImagen);
    }

    
    $nombre = uniqid() . "_" . basename($_FILES['pfp']['name']);

    $rutaServidor = __DIR__ . "/ASSETS/ProfilePictures/" . $nombre;

    if(move_uploaded_file($_FILES['pfp']['tmp_name'], $rutaServidor)){
        mysqli_query($conexion, "UPDATE users SET pfp='$nombre' WHERE user_id='$id'");
    } else {
        echo "error:No se pudo subir la imagen";
        exit;
    }
}

echo "ok";
?>