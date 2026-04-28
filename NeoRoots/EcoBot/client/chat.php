<?php
header("Content-Type: application/json");

$apiKey = "AIzaSyAssBlmAO0PWbQ-q877O2-VYxBvaskrVeQ";


// Leer entrada
$input = json_decode(file_get_contents("php://input"), true);
$mensaje = $input["mensaje"] ?? "";

if (!$mensaje) {
    echo json_encode(["respuesta" => "Mensaje vacío"]);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

$prompt = "Eres EcoBot, experto en reciclaje. Clasifica residuos en orgánico, reciclable o no reciclable y responde en 1 línea.\nUsuario: " . $mensaje;

$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $prompt]
            ]
        ]
    ]
];

$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => json_encode($data),
        "ignore_errors" => true
    ]
];

$response = file_get_contents($url, false, stream_context_create($options));

// 🔥 DEBUG (CLAVE)
if ($response === FALSE) {
    echo json_encode(["respuesta" => "Error conectando con Gemini"]);
    exit;
}

$result = json_decode($response, true);

// 🔥 MANEJO SEGURO DE RESPUESTA
if (
    isset($result["candidates"]) &&
    isset($result["candidates"][0]["content"]["parts"][0]["text"])
) {
    $respuesta = $result["candidates"][0]["content"]["parts"][0]["text"];
} else {
    // 🔥 Mostrar error real (esto te ayuda mucho)
    $respuesta = "Error real: " . json_encode($result);
}

echo json_encode(["respuesta" => $respuesta]);