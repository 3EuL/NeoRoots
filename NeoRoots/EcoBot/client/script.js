const toggle =
document.getElementById("chatbot-toggle");

const container =
document.getElementById("chatbot-container");

const closeBtn =
document.getElementById("close-chat");

const sendBtn =
document.getElementById("send-btn");

const input =
document.getElementById("chatbot-input");

const messages =
document.getElementById("chatbot-messages");

/* =========================================
   ABRIR / CERRAR CHAT
========================================= */

toggle.onclick = () => {

    if(container.style.display === "flex"){

        container.style.display = "none";

    }else{

        container.style.display = "flex";

        input.focus();

    }

};

closeBtn.onclick = () => {

    container.style.display = "none";

};

/* =========================================
   ENVIAR CON BOTÓN
========================================= */

sendBtn.onclick = enviar;

/* =========================================
   ENVIAR CON ENTER
========================================= */

input.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Enter"){

            e.preventDefault();

            enviar();

        }

    }
);

/* =========================================
   FUNCIÓN ENVIAR
========================================= */

async function enviar(){

    const texto =
    input.value.trim();

    if(!texto) return;

    /* =========================
       MENSAJE USUARIO
    ========================= */

    agregarMensaje(
        texto,
        "user-message"
    );

    input.value = "";

    /* =========================
       ESCRIBIENDO...
    ========================= */

    const typing =
    agregarMensaje(
        "🌱 EcoBot está escribiendo...",
        "bot-message typing"
    );

    try{

        const res =
        await fetch("chat.php", {

            method:"POST",

            headers:{
                "Content-Type":
                "application/json"
            },

            body:JSON.stringify({
                mensaje:texto
            })

        });

        /* =========================
           ERROR SERVIDOR
        ========================= */

        if(!res.ok){

            throw new Error(
                "Error del servidor"
            );

        }

        const data =
        await res.json();

        /* =========================
           QUITAR ESCRIBIENDO
        ========================= */

        typing.remove();

        /* =========================
           RESPUESTA BOT
        ========================= */

        let respuesta =
        data.respuesta ||
        "No pude responder.";

        /* =========================
           FORMATO BONITO
        ========================= */

        respuesta = respuesta

        // negritas markdown
        .replace(
            /\*\*(.*?)\*\*/g,
            "<b>$1</b>"
        )

        // saltos de línea
        .replace(
            /\n/g,
            "<br>"
        )

        // listas
        .replace(
            /^\- (.*$)/gim,
            "• $1"
        );

        agregarMensajeHTML(
            respuesta,
            "bot-message"
        );

    }catch(error){

        typing.remove();

        agregarMensaje(
            "❌ Error de conexión con el servidor.",
            "bot-message"
        );

        console.error(error);

    }

}

/* =========================================
   MENSAJE NORMAL
========================================= */

function agregarMensaje(
    texto,
    clase
){

    const div =
    document.createElement("div");

    div.className = clase;

    div.innerText = texto;

    messages.appendChild(div);

    scrollAbajo();

    return div;

}

/* =========================================
   MENSAJE HTML
========================================= */

function agregarMensajeHTML(
    html,
    clase
){

    const div =
    document.createElement("div");

    div.className = clase;

    div.innerHTML = html;

    messages.appendChild(div);

    scrollAbajo();

}

/* =========================================
   AUTO SCROLL
========================================= */

function scrollAbajo(){

    messages.scrollTop =
    messages.scrollHeight;

}