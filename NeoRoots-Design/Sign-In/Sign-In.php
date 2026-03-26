<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - NeoRoots</title>
    <!-- OJO: Usamos el MISMO archivo CSS del Login para que mantenga el diseño de cristal -->
    <link rel="stylesheet" href="../CSS/Login.css"> 
</head>
<body>

    <!-- Fondo y Contenedor Principal -->
    <div class="login-wrapper">
        
        <!-- La Cajita de Cristal (Aprovechamos las mismas clases del CSS) -->
        <div class="login-box">
            <img src="../Logos/LogoProyecto.png" alt="NeoRoots Logo" class="login-logo">
            
            <h2>Únete a NeoRoots</h2>
            <p>Regístrate y sé parte de la solución para un mundo más limpio.</p>

            <form action="#" method="POST" class="login-form">
                
                <!-- Campo Nuevo: Nombre -->
                <div class="input-box">
                    <input type="text" placeholder="Tu Nombre Completo" required>
                </div>

                <div class="input-box">
                    <input type="email" placeholder="Correo Electrónico" required>
                </div>
                
                <div class="input-box">
                    <input type="password" placeholder="Crea una Contraseña" required>
                </div>

                <!-- Campo Nuevo: Confirmar Contraseña -->
                <div class="input-box">
                    <input type="password" placeholder="Confirma tu Contraseña" required>
                </div>

                <button type="submit" class="btn-login">CREAR CUENTA</button>

                <div class="register-link">
                    <p>¿Ya tienes una cuenta? <a href="../Log-In/Login.php">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
