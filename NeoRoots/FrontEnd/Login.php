<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - NeoRoots</title>
    <link rel="stylesheet" href="../CSS/Login_Register.css"> 
</head>
<body>

    <div class="login-wrapper">
        
    
        <div class="login-box">
            <img src="../Assets/Logos/LogoProyecto.png" alt="NeoRoots Logo" class="login-logo">
            
        
            <h2>Accede a tu cuenta</h2>
            <p>Ingresa tus datos para continuar cuidando el planeta.</p>

            <form id="loginForm" method="post" class="login-form">
                <div class="input-box">
                    <input type="text" name="login" placeholder="Correo Electrónico o Usuario">
            
                    <input type="password" name="pass" placeholder="Contraseña">
                </div>

                <div class="forgot-pass">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>

                <input type="submit" value="INGRESAR" class="btn-login"></input>

                <div class="register-link">
                    <p>¿No tienes cuenta? <a href="Sign-In.php">Regístrate aquí</a></p>
                </div>
            </form>
        </div>

    </div>

    <div id="toastContainer"></div>

    <script src="../JS/login.js"></script>

</body>
</html>