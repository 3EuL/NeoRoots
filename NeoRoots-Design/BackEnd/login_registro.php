<?php
require_once 'conexion.php';

/* ===== REGISTRO ===== */
if(isset($_POST['user'], $_POST['email'], $_POST['pass'], $_POST['rol'])){

    $user = $_POST["user"];
    $email = $_POST["email"];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $rol = $_POST["rol"];

    /* VALIDACIONES */
    if(empty($user) || empty($email) || empty($_POST['pass']) || empty($rol)){
        echo "error:Todos los campos son obligatorios";
        exit;
    }
    
    if($_POST['pass'] !== $_POST['repass']){
    echo "error:Las contraseñas no coinciden";
    exit;
    }
    
    /* VERIFICAR SI YA EXISTE */
    $check = $conexion->query("SELECT * FROM users WHERE user='$user' OR email='$email'");
    
    if($check->num_rows > 0){
        echo "error:El usuario o correo ya existe";
        exit;
    }

    /* INSERTAR */
    if($conexion->query("INSERT INTO users (user, email, rol, pass) VALUES ('$user', '$email', '$rol', '$pass')")){
        echo "ok";
    }else{
        echo "error:No se pudo registrar";
    }

    exit();
}

/* ===== BOTÓN LOGIN ===== */
if(isset($_POST['login'])){
    echo "redirect:login";
    exit();
}
?>
