<?php

require_once 'conecxion.php';

if(isset($_POST['registrate'])){
$user = $_POST["user"];
$email = $_POST["email"];
$pass = $_POST["pass"];


$conn->query("INSERT INTO users (user, email, pass) VALUES ('$user', '$email', '$pass')");

header("location: Log-In/Login.php");
exit();
}
?>
