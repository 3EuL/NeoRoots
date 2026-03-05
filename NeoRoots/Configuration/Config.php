<?php
include("../conexion.php");

if(isset($_POST['guardar'])){

$user_id = $_POST['user_id'];
$user = $_POST['user'];
$email = $_POST['email'];
$pass = $_POST['pass'];

if(!empty($pass)){

    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users 
            SET user='$user', email='$email', pass='$passHash'
            WHERE user_id='$user_id'";

}else{

    $sql = "UPDATE users 
            SET user='$user', email='$email'
            WHERE user_id='$user_id'";

}

mysqli_query($conexion,$sql);

echo "<script>alert('Datos actualizados correctamente');</script>";

}
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
    <section id="view-config" class="view">
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