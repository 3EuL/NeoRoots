<?php
    session_start();
    require_once 'conexion.php';

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        //consultar email existe
        $sql = "SELECT * FROM users WHERE email='$email'";
        $resultado = $conn->query($sql);

        $sql1 = "SELECT * FROM users WHERE user='$email'";
        $resultado1 = $conn->query($sql1);


        if(($resultado->num_rows > 0) || ($resultado1->num_rows > 0)){
            $user = $resultado->fetch_assoc();
            $user1 = $resultado1->fetch_assoc();

            //Validar contraseña
            if(($pass === $user['pass']) || ($pass === $user1['pass'])){
                //Crear sesión
                $_SESSION['id'] = $user['id'];
                $_SESSION['user'] = $user['user'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['id'] = $user1['id'];
                $_SESSION['user'] = $user1['user'];
                $_SESSION['rol'] = $user1['rol'];

                //Direccionar segun el rol
                if(($user['rol'] === 'admin') || ($user1['rol'] === 'admin')){
                    header("location: Hub/Hub.php");
                }else{
                    header("location: Hub/Hub.php");
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