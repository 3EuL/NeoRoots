<?php
    session_start();
    require_once 'conexion.php';

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        //consultar email existe
        $sql = "SELECT * FROM users WHERE email='$email'";
        $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){
            $user = $resultado->fetch_assoc();

            //Validar contraseña
            if($pass === $user['clave']){
                //Crear sesión
                $_SESSION['id'] = $user['id'];
                $_SESSION['user'] = $user['user'];
                $_SESSION['rol'] = $user['rol'];

                //Direccionar segun el rol
                if($user['rol'] === 'admin'){
                    header("location: ../Hub.html");
                }else{
                    header("location: ../Hub.html");
                }
                
                exit();
            }else{
                echo "Clave incorreta";
            }
        }else{
            echo "El usuario no existe";
        }
    }
?>    