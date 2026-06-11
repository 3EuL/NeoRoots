<?php

header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"), true);

$mensaje = strtolower(trim($input["mensaje"] ?? ""));

function respuestaAleatoria($respuestas){
    return $respuestas[array_rand($respuestas)];
}

$respuesta = null;

/* =========================
   SALUDOS
========================= */

if (
    preg_match('/\b(hola|buenas|hey|saludos|buenos dias|buenas tardes|buenas noches)\b/u', $mensaje)
) {

    $respuesta = respuestaAleatoria([
        "¡Hola! 🌱 Soy EcoBot. Estoy aquí para ayudarte con reciclaje, residuos y cuidado del medio ambiente.",
        "¡Bienvenido! ♻️ Puedes preguntarme sobre reciclaje, contaminación, ahorro de agua y sostenibilidad.",
        "¡Hola! 🌎 Estoy listo para ayudarte con temas ambientales."
    ]);
}

/* =========================
   DESPEDIDAS
========================= */

elseif (
    preg_match('/\b(adios|adiós|chao|hasta luego|nos vemos)\b/u', $mensaje)
) {

    $respuesta = respuestaAleatoria([
        "¡Hasta pronto! 🌱 Recuerda que cada acción cuenta para cuidar el planeta.",
        "♻️ Gracias por contribuir al cuidado del medio ambiente. ¡Nos vemos!",
        "🌎 ¡Hasta luego! Sigue reciclando y ayudando al planeta."
    ]);
}

/* =========================
   AGRADECIMIENTOS
========================= */

elseif (
    preg_match('/\b(gracias|muchas gracias)\b/u', $mensaje)
) {

    $respuesta = "🌱 ¡Con gusto! Siempre estaré disponible para ayudarte con temas ambientales.";
}

/* =========================
   RECICLAJE
========================= */

elseif (
    strpos($mensaje,"reciclaje") !== false ||
    strpos($mensaje,"reciclar") !== false
) {

    $respuesta = respuestaAleatoria([

        "♻️ Reciclar consiste en transformar materiales usados en nuevos productos. Esto reduce la contaminación y el consumo de recursos naturales.",

        "🌎 El reciclaje ayuda a disminuir la cantidad de residuos que llegan a los rellenos sanitarios y permite aprovechar materiales que aún tienen valor.",

        "♻️ Gracias al reciclaje se pueden reutilizar materiales como papel, plástico, vidrio y metales para fabricar nuevos productos."
    ]);
}

/* =========================
   PLÁSTICO
========================= */

elseif (
    strpos($mensaje,"plastico") !== false ||
    strpos($mensaje,"plástico") !== false ||
    strpos($mensaje,"botella") !== false ||
    strpos($mensaje,"envase") !== false
) {

    $respuesta = respuestaAleatoria([

        "♻️ Los envases y botellas plásticas deben estar limpios y secos antes de reciclarse. Esto facilita su aprovechamiento y reduce la contaminación.",

        "🌱 El plástico puede tardar cientos de años en degradarse. Por eso es importante separarlo correctamente para que pueda reciclarse.",

        "♻️ Muchos productos plásticos pueden transformarse en nuevos materiales mediante procesos de reciclaje."
    ]);
}

/* =========================
   PAPEL Y CARTÓN
========================= */

elseif (
    strpos($mensaje,"papel") !== false ||
    strpos($mensaje,"carton") !== false ||
    strpos($mensaje,"cartón") !== false
) {

    $respuesta = "📄 El papel y el cartón son materiales reciclables. Deben depositarse limpios y secos para que puedan convertirse en nuevos productos.";
}

/* =========================
   VIDRIO
========================= */

elseif (
    strpos($mensaje,"vidrio") !== false ||
    strpos($mensaje,"frasco") !== false
) {

    $respuesta = "🍾 El vidrio puede reciclarse infinitamente sin perder calidad. Botellas y frascos deben depositarse vacíos y limpios.";
}

/* =========================
   METALES
========================= */

elseif (
    strpos($mensaje,"metal") !== false ||
    strpos($mensaje,"aluminio") !== false ||
    strpos($mensaje,"lata") !== false
) {

    $respuesta = "🥫 Los metales como aluminio y acero son altamente reciclables y pueden reutilizarse muchas veces sin perder sus propiedades.";
}

/* =========================
   COMPOSTAJE
========================= */

elseif (
    strpos($mensaje,"compost") !== false ||
    strpos($mensaje,"organico") !== false ||
    strpos($mensaje,"orgánico") !== false
) {

    $respuesta = "🍃 El compostaje transforma residuos orgánicos como cáscaras de frutas y restos vegetales en abono natural para las plantas.";
}

/* =========================
   PILAS
========================= */

elseif (
    strpos($mensaje,"pila") !== false ||
    strpos($mensaje,"bateria") !== false ||
    strpos($mensaje,"batería") !== false
) {

    $respuesta = "🔋 Las pilas y baterías no deben desecharse con la basura común porque contienen sustancias que pueden contaminar el suelo y el agua.";
}

/* =========================
   ELECTRÓNICOS
========================= */

elseif (
    strpos($mensaje,"electronico") !== false ||
    strpos($mensaje,"electrónico") !== false ||
    strpos($mensaje,"celular") !== false ||
    strpos($mensaje,"computador") !== false
) {

    $respuesta = "💻 Los residuos electrónicos deben llevarse a puntos de recolección especializados para evitar la contaminación y recuperar materiales útiles.";
}

/* =========================
   CONTAMINACIÓN
========================= */

elseif (
    strpos($mensaje,"contaminacion") !== false ||
    strpos($mensaje,"contaminación") !== false
) {

    $respuesta = "🌍 La contaminación afecta el aire, el agua y los ecosistemas. Reducir residuos y reciclar correctamente ayuda a disminuir su impacto.";
}

/* =========================
   CAMBIO CLIMÁTICO
========================= */

elseif (
    strpos($mensaje,"cambio climatico") !== false ||
    strpos($mensaje,"calentamiento global") !== false
) {

    $respuesta = "🌡️ El cambio climático es causado principalmente por el aumento de gases de efecto invernadero. Reducir el consumo excesivo y reciclar contribuye a mitigarlo.";
}

/* =========================
   CANECA BLANCA
========================= */

elseif (
    strpos($mensaje,"caneca blanca") !== false
) {

    $respuesta = "♻️ La caneca blanca es para residuos aprovechables como papel, cartón, plástico, vidrio y metales limpios y secos.";
}

/* =========================
   CANECA VERDE
========================= */

elseif (
    strpos($mensaje,"caneca verde") !== false
) {

    $respuesta = "🍃 La caneca verde es para residuos orgánicos como restos de frutas, verduras y residuos de jardinería.";
}

/* =========================
   CANECA NEGRA
========================= */

elseif (
    strpos($mensaje,"caneca negra") !== false
) {

    $respuesta = "🗑️ La caneca negra es para residuos no aprovechables como papel higiénico, servilletas usadas y empaques contaminados.";
}

/* =========================
   CONSEJOS
========================= */

elseif (
    strpos($mensaje,"consejo") !== false ||
    strpos($mensaje,"tip") !== false
) {

    $respuesta = respuestaAleatoria([

        "🌱 Usa bolsas reutilizables para reducir el consumo de plástico.",

        "💧 Cierra la llave mientras te cepillas los dientes para ahorrar agua.",

        "♻️ Separa correctamente tus residuos para facilitar el reciclaje.",

        "🚲 Camina o utiliza bicicleta cuando sea posible para reducir emisiones."
    ]);
}

/* =========================
   DATOS CURIOSOS
========================= */

elseif (
    strpos($mensaje,"dato curioso") !== false ||
    strpos($mensaje,"sabias que") !== false ||
    strpos($mensaje,"sabías que") !== false
) {

    $respuesta = respuestaAleatoria([

        "🌎 ¿Sabías que reciclar una tonelada de papel puede ayudar a salvar hasta 17 árboles?",

        "♻️ Una botella de vidrio puede reciclarse infinitamente sin perder calidad.",

        "💧 Menos del 1% del agua del planeta está disponible para consumo humano."
    ]);
}

/* =========================
   RESPUESTA FINAL
========================= */

if ($respuesta === null) {

    $respuesta = "🌱 Lo siento, solo puedo ayudarte con temas relacionados con reciclaje, residuos, sostenibilidad y cuidado del medio ambiente.";
}

echo json_encode([
    "respuesta" => $respuesta
]);