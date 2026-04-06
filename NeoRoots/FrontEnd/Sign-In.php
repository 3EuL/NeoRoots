<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link rel="stylesheet" href="../CSS/Sign-In.css">
    <link rel="shortcut icon" href="Logos/LogoProyecto.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
</head>

<body>

<main>

    <!-- ===== PANEL IZQUIERDO ===== -->
    <section id="Filler">
        <h1>Une</h1>
        <h1>Te</h1>
        <h1>Nos</h1>
    </section>

    <!-- ===== FORMULARIO ===== -->
    <section id="Formulary">

        <div class="hub">
            
            <div class="tittle">
                <h1>Forma parte de nuestra familia</h1>
            </div>

            <form id="signInForm" method="post">

                <div class="data">

                    <label for="user">Usuario</label>
                    <input type="text" name="user" id="user" placeholder="Ingresar Usuario...">

                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" placeholder="Ingresar Correo...">

                    <label for="rol">Selecciona tu rol</label>
                    <select name="rol" id="rol">
                        <option value="">--Selecciona un rol--</option>
                        <option value="usuario">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>

                    <label for="password">Contraseña</label>
                    <input type="password" name="pass" id="password" placeholder="Ingresar Contraseña...">

                    <label for="confirmpassword">Confirmar Contraseña</label>
                    <input type="password" name="repass" id="confirmpassword" placeholder="Repetir contraseña...">

                    <input type="submit" value="Registrarse" name="registrate">

                    <input type="button" value="Ya tengo cuenta"
                        onclick="window.location.href='../Log-In/Login.php'">

                </div>

            </form>

        </div>

    </section>

</main>

<!-- ===== TOAST GLOBAL (FUERA DEL LAYOUT) ===== -->
<div id="toastContainer"></div>

<script src="../JS/sign_in.js"></script>

</body>
</html>