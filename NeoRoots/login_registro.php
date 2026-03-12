<?php

require_once 'conexion.php';

if(isset($_POST['registrate'])){
$user = $_POST["user"];
$email = $_POST["email"];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$rol = $_POST["rol"];


$conexion->query("INSERT INTO users (user, email, rol, pass) VALUES ('$user', '$email', '$rol', '$pass')");

header("location: Log-In/Login.php");
exit();
}
?>
