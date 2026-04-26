<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - NeoRoots</title>
    
    <link rel="stylesheet" href="../CSS/Login_Register.css"> 
</head>
<body>

    
    <div class="login-wrapper">
        
       
        <div class="login-box">
            <img src="../ASSETS/Logos/LogoProyecto.png" alt="NeoRoots Logo" class="login-logo">
            
            <h2>Únete a NeoRoots</h2>
            <p>Regístrate y sé parte de la solución para un mundo más limpio.</p>

            <form method="post" class="login-form" id="signInForm">
                
                
                <div class="input-box">
                    <input type="text" name="user" placeholder="Tu Nombre Completo">


                    <input type="email" name="email" placeholder="Correo Electrónico">

                    <select name="rol" id="rol">
                        <option value="">--Selecciona un rol--</option>
                        <option value="usuario">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>

                    <input type="password" name="pass" placeholder="Crea una Contraseña">


                
                    <input type="password" name="repass" placeholder="Confirma tu Contraseña">
                </div>

                <input type="submit" value="CREAR CUENTA" name="registrate" class="btn-login"></input>

                <div class="register-link">
                    <p>¿Ya tienes una cuenta? <a href="Login.php">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>

    </div>

    <div id="toastContainer"></div>

    <script src="../JS/sign_in.js"></script>

</body>
</html>
