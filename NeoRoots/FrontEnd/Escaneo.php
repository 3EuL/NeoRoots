<?php

session_start();

if(!isset($_SESSION["user_id"])){

    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaneo</title>
    <link rel="stylesheet" href="../CSS/Escaneo.css">
</head>
<body>
    <h1 style="justify-self: center;
    text-transform: uppercase;
    ">Elije el contenedor correcto</h1>
     
     <div style="text-align:center; margin: 20px 0;">

    <div id="panelPuntos">
  🏆 Puntos: <span id="puntosUsuario">0</span>
</div>
  <img
    id="camara"
    src="http://127.0.0.1:5000/video"
    width="420"
    style="
        border-radius:15px;
        border:4px solid #2aa845;
    "
>

  <div id="resultado" class="resultado">

    <h2>Esperando detección...</h2>

</div>
</div>
    
    <div class="grid">
        

        <div class="contenedores">

            <div class="contenedor" data-points="10">  
              <h2>♻️ Plástico</h2>
              <p>Escanear</p>
            </div>
          
            <div class="contenedor" data-points="20">
              <h2>📄 Papel</h2>
              <p>Escanear</p>
            </div>
          
            <div class="contenedor" data-points="30">
              <h2>🍾 Vidrio</h2>
              <p>Escanear</p>
            </div>
          
        </div>
          
    </div>
    <div id="notificacion" class="notificacion"></div>
    <script src="../JS/scan.js"></script>
    <div id="animacionPuntos" class="animacion-puntos"></div>
</body>
</html>