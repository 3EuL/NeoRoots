<?php
session_start();
include("conexion.php");

$id = $_POST['user_id'];
$user = $_POST['user'];
$email = $_POST['email'];

$pass = $_POST['pass'] ?? '';
$confirm = $_POST['confirm_pass'] ?? '';


/* ===== VALIDACIÓN CONTRASEÑA OPCIONAL ===== */
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
            password='$passHash'
            WHERE user_id='$id'";

}else{

    $sql = "UPDATE users SET 
            user='$user',
            email='$email'
            WHERE user_id='$id'";
}


/* ===== FOTO ===== */
if(isset($_FILES['pfp']) && $_FILES['pfp']['error'] == 0){

    $nombre = time() . "_" . $_FILES['pfp']['name'];
    $ruta = "Images/" . $nombre;

    move_uploaded_file($_FILES['pfp']['tmp_name'], $ruta);

    mysqli_query($conexion, "UPDATE users SET pfp='$nombre' WHERE user_id='$id'");
}


/* ===== EJECUTAR ===== */
if(mysqli_query($conexion, $sql)){
    echo "ok";
}else{
    echo "error:No se pudo actualizar";
}

?>