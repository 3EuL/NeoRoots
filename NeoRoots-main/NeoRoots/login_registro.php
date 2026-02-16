<?php

require_once 'conexion.php';

if(isset($_POST['registrate'])){
$user = $_POST["user"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$rol = $_POST["rol"];


$conn->query("INSERT INTO users (user, email, rol, pass) VALUES ('$user', '$email', '$rol', '$pass')");

header("location: ../Login.php");
exit();
}
?>
