<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../Log-In/Login.php");
    exit();
}

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id='$id'";
$resultado = mysqli_query($conexion,$sql);

$usuario = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Config.css">
</head>
<body>
    <section id="view-config" class="view"  style="display:block;>
        <h1>Configuración de la cuenta</h1>
    
        <form id="configForm" method="POST" action="Config.php">

        <input type="hidden" name="user_id" value="<?php echo $usuario['user_id']; ?>">

        <label>Nombre de usuario</label>
        <input type="text" name="user"
        value="<?php echo $usuario['user']; ?>">

        <label>Correo electrónico</label>
        <input type="email" name="email"
        value="<?php echo $usuario['email']; ?>">

        <label>Contraseña</label>
        <input type="password" name="pass"
        placeholder="Cambiar contraseña">

        <button type="submit" name="guardar">Guardar cambios</button>

        <a href="../Page-Reports/Reports.html">Regresar</a>

    </form>
            <p id="saveMsg" class="hidden">Cambios guardados ✔</p>
        </div>
    </section>
</body>
</html>