<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - NeoRoots</title>
    <link rel="stylesheet" href="../CSS/Login.css"> <!-- Ojo: Asegúrate de que esta ruta apunte a tu CSS -->
</head>
<body>

    <!-- Fondo y Contenedor Principal -->
    <div class="login-wrapper">
        
        <!-- La Cajita de Cristal -->
        <div class="login-box">
            <img src="../Logos/LogoProyecto.png" alt="NeoRoots Logo" class="login-logo">
            
            <!-- Adiós al Bienvenidos, hola al diseño moderno -->
            <h2>Accede a tu cuenta</h2>
            <p>Ingresa tus datos para continuar cuidando el planeta.</p>

            <form action="#" method="POST" class="login-form">
                <div class="input-box">
                    <input type="email" placeholder="Correo Electrónico" required>
                </div>
                
                <div class="input-box">
                    <input type="password" placeholder="Contraseña" required>
                </div>

                <div class="forgot-pass">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-login">INGRESAR</button>

                <div class="register-link">
                    <p>¿No tienes cuenta? <a href="../Sign-In/Sign-In.php">Regístrate aquí</a></p>
                </div>
            </form>
        </div>

    </div>

</body>
</html>