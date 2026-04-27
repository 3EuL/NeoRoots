<?php
include 'db.php';

// CREAR
if(isset($_POST['crear'])){
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users (user,email,pass) 
                  VALUES ('$user','$email','$pass')");
}

// EDITAR
if(isset($_POST['editar'])){
    $id = $_POST['id'];
    $user = $_POST['username'];
    $email = $_POST['email'];

    if(!empty($_POST['password'])){
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET user='$user', email='$email', password='$pass' WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET user='$user', email='$email' WHERE user_id=$id");
    }
}

// ELIMINAR
if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $conn->query("DELETE FROM users WHERE user_id=$id");
}

header("Location: ../users.php");