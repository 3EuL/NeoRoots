<?php
session_start();
include("../BackEnd/conexion.php");

if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit();
}

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id='$id'";
$result = mysqli_query($conexion, $sql);
$usuario = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="../CSS/Config.css">
</head>

<body>

    <section class="view">

        <div class="config-container">

            <h1>Configuración de la cuenta</h1>


            <div class="profile-section">
                <img id="profilePic" src="../ASSETS/ProfilePictures/<?php echo $usuario['pfp'] ? $usuario['pfp'] : 'default.png'; ?>">

                <label for="pfpUpload" class="upload-btn">Cambiar foto</label>

                <input type="file" id="pfpUpload" name="pfp" form="configForm" hidden>
        </div>


        <form id="configForm" enctype="multipart/form-data">

            <input type="hidden" name="user_id" value="<?php echo $usuario['user_id']; ?>">

            <label>Usuario</label>
            <input type="text" name="user" value="<?php echo $usuario['user']; ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>">


            <button type="button" id="togglePass">Cambiar contraseña</button>

            <div id="passwordSection" class="hidden">

            <label>Nueva contraseña</label>
            <input type="password" name="pass">

            <label>Confirmar contraseña</label>
            <input type="password" name="confirm_pass">

    </div>

<button type="submit">Guardar cambios</button>

<a class="back" href="Hub.php">Regresar</a>

</form>

<div id="toastContainer"></div>



</div>

</section>

<script src="../JS/config.js"></script>

</body>
</html>