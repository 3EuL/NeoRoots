<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

/* =========================
   API KEY OPENROUTER
========================= */

$apiKey = "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";

/* =========================
   MENSAJE
========================= */

$input = json_decode(
    file_get_contents("php://input"),
    true
);

$mensaje = trim($input["mensaje"] ?? "");

if(!$mensaje){

    echo json_encode([
        "respuesta" => "Mensaje vacío."
    ]);

    exit;
}

/* =========================
   PROMPT
========================= */

$prompt = "

Eres EcoBot, un chatbot ambiental.

SOLO respondes temas relacionados con:
- reciclaje
- residuos
- contaminación
- medio ambiente
- sostenibilidad

Si preguntan algo diferente responde:
'Solo puedo responder temas ambientales 🌱'

Usuario:
".$mensaje;

/* =========================
   DATOS
========================= */

$data = [

    "model" => "openai/gpt-3.5-turbo",

    "messages" => [

        [
            "role" => "user",
            "content" => $prompt
        ]

    ]

];

/* =========================
   CURL
========================= */

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

/* =========================
   ERROR CURL
========================= */

if(curl_errno($ch)){

    echo json_encode([

        "respuesta" =>
        "ERROR CURL: ".curl_error($ch)

    ]);

    exit;
}

curl_close($ch);

/* =========================
   DEBUG RESPUESTA
========================= */

$response = json_decode($result, true);

/* ERROR API */

if(isset($response["error"])){

    echo json_encode([

        "respuesta" =>
        "ERROR API: ".
        $response["error"]["message"]

    ]);

    exit;
}

/* RESPUESTA */

$respuesta =
$response["choices"][0]["message"]["content"]
?? null;

/* SI NO HAY RESPUESTA */

if(!$respuesta){

    echo json_encode([

        "respuesta" =>
        "La IA no devolvió respuesta.",

        "debug" => $response

    ]);

    exit;
}

/* =========================
   DEVOLVER
========================= */

echo json_encode([

    "respuesta" => nl2br($respuesta)

]);

?>