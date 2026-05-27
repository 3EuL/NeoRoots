<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

/* =========================================
   API KEY OPENROUTER
========================================= */

$apiKey = "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";

/* =========================================
   RECIBIR MENSAJE
========================================= */

$input = json_decode(
    file_get_contents("php://input"),
    true
);

$mensaje = trim($input["mensaje"] ?? "");

/* =========================================
   VALIDAR MENSAJE
========================================= */

if(!$mensaje){

    echo json_encode([
        "respuesta" => "Mensaje vacío."
    ]);

    exit;
}

/* =========================================
   PROMPT DEL BOT
========================================= */

$prompt = "

Eres EcoBot, un asistente virtual ambiental moderno y amigable.

Puedes:
- saludar
- despedirte
- tener conversaciones básicas

Tu especialidad es:
- reciclaje
- residuos
- sostenibilidad
- contaminación
- cuidado ambiental
- separación de basura

Si el usuario pregunta algo completamente fuera de esos temas
(como hacking, videojuegos, matemáticas, etc),
responde solamente:

Solo puedo ayudarte con temas ambientales 🌱

IMPORTANTE:
- Responde corto
- Responde claro
- Usa un tono amigable
- Usa emojis ambientales ocasionalmente

Usuario:
".$mensaje;

/* =========================================
   DATOS OPENROUTER
========================================= */

$data = [

    "model" => "openrouter/free",

    "messages" => [

        [
            "role" => "user",
            "content" => $prompt
        ]

    ]

];

/* =========================================
   CURL
========================================= */

$ch = curl_init(
    "https://openrouter.ai/api/v1/chat/completions"
);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    [

        "Authorization: Bearer ".$apiKey,
        "HTTP-Referer: http://localhost",
        "X-Title: EcoBot",
        "Content-Type: application/json"

    ]
);

curl_setopt(
    $ch,
    CURLOPT_POSTFIELDS,
    json_encode($data)
);

curl_setopt(
    $ch,
    CURLOPT_SSL_VERIFYPEER,
    false
);

$result = curl_exec($ch);

/* =========================================
   ERROR CURL
========================================= */

if(curl_errno($ch)){

    echo json_encode([

        "respuesta" =>
        "Error CURL: ".curl_error($ch)

    ]);

    exit;
}

curl_close($ch);

/* =========================================
   DECODIFICAR RESPUESTA
========================================= */

$response = json_decode($result, true);

/* =========================================
   ERROR API
========================================= */

if(isset($response["error"])){

    echo json_encode([

        "respuesta" =>
        "Error API: ".
        $response["error"]["message"]

    ]);

    exit;
}

/* =========================================
   RESPUESTA IA
========================================= */

$respuesta =
$response["choices"][0]["message"]["content"]
?? "No pude responder.";

/* =========================================
   DEVOLVER RESPUESTA
========================================= */

echo json_encode([

    "respuesta" => nl2br($respuesta)

]);

?>