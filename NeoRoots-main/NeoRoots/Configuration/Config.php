<?php
    include("../procesador_config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Configuración</title>

<link rel="stylesheet" href="../CSS/Config.css">

</head>

<body>

<section id="view-config" class="view">

<div class="config-container">

<h1>Configuración de la cuenta</h1>

<div class="profile-section">

<img id="profilePic" 
src="../Images/<?php echo $usuario['pfp']; ?>" 
alt="Foto de perfil">

<label for="pfpUpload" class="upload-btn">
Cambiar foto
</label>

<input 
type="file" 
id="pfpUpload"
name="pfp" 
form="configForm"
accept="image/*"
hidden>

</div>

<form id="configForm" method="POST" action="../procesador_config.php" enctype="multipart/form-data">

<input type="hidden" name="user_id" value="<?php echo $usuario['user_id']; ?>">

<label>Nombre de usuario</label>
<input type="text" name="user"
value="<?php echo $usuario['user']; ?>">

<label>Correo electrónico</label>
<input type="email" name="email"
value="<?php echo $usuario['email']; ?>">

<label>Contraseña</label>
<input type="password" name="pass"
placeholder="Nueva contraseña">

<label>Confirmar contraseña</label>
<input type="password" name="confirm_pass"
placeholder="Confirmar contraseña">

<button type="submit" name="guardar">
Guardar cambios
</button>

<a class="back" href="Hub/Hub.php">
Regresar
</a>

</form>

<p id="saveMsg" class="<?php echo $guardado ? '' : 'hidden'; ?>">
Cambios guardados ✔
</p>

<p id="errorMsg" class="hidden"></p>

</div>

</section>

<script src="../JS/config.js"></script>
</body>
</html>