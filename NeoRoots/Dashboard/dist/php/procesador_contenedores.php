<?php
include 'db.php';

/* CREAR */
if(isset($_POST['crear'])){
    $colour = $_POST['colour'];
    $type = $_POST['waste_type'];
    $desc = $_POST['description'];

    $conn->query("INSERT INTO containers (colour, waste_type, description)
                  VALUES ('$colour','$type','$desc')");

    $redirect = $_SERVER['HTTP_REFERER'] ?? '../contenedores.php';
    header("Location: " . $redirect);
    exit();
}

/* EDITAR */
if(isset($_POST['editar'])){
    $id = $_POST['id'];
    $colour = $_POST['colour'];
    $type = $_POST['waste_type'];
    $desc = $_POST['description'];

    $conn->query("UPDATE containers 
                  SET colour='$colour',
                      waste_type='$type',
                      description='$desc'
                  WHERE container_id=$id");

    $redirect = $_SERVER['HTTP_REFERER'] ?? '../contenedores.php';
    header("Location: " . $redirect);
    exit();
}

/* ELIMINAR */
if(isset($_POST['delete'])){
    $id = intval($_POST['delete']);

    if(!$conn->query("DELETE FROM containers WHERE container_id=$id")){
        die("Error al eliminar: " . $conn->error);
    }

   $redirect = $_SERVER['HTTP_REFERER'] ?? '../contenedores.php';
    header("Location: " . $redirect);
    exit();
}