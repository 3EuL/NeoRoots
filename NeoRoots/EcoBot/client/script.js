const sendBtn = document.getElementById("send-btn");

const input = document.getElementById("chatbot-input");

const messages = document.getElementById("chatbot-messages");

/* =========================
   ENTER
========================= */

input.addEventListener("keydown", function(e){

    if(e.key === "Enter"){

        e.preventDefault();

        enviar();
    }

});

/* =========================
   BOTÓN ENVIAR
========================= */

sendBtn.addEventListener("click", enviar);

/* =========================
   FUNCIÓN ENVIAR
========================= */

function enviar(){

    const texto = input.value.trim();

    if(!texto) return;

    /* MENSAJE USUARIO */

    const userMsg = document.createElement("div");

    userMsg.className = "user-message";

    userMsg.innerText = texto;

    messages.appendChild(userMsg);

    input.value = "";

    /* MENSAJE ESCRIBIENDO */

    const typing = document.createElement("div");

    typing.className = "bot-message";

    typing.innerText = "🌱 EcoBot está escribiendo...";

    messages.appendChild(typing);

    messages.scrollTop = messages.scrollHeight;

    /* CONSULTA PHP */

    fetch("chat.php",{

        method:"POST",

        headers:{
            "Content-Type":"application/json"
        },

        body:JSON.stringify({
            mensaje:texto
        })

    })

    .then(response => response.json())

    .then(data => {

        typing.remove();

        const botMsg = document.createElement("div");

        botMsg.className = "bot-message";

        botMsg.innerText = data.respuesta;

        messages.appendChild(botMsg);

        messages.scrollTop = messages.scrollHeight;

    })

    .catch(error => {

        typing.remove();

        const botMsg = document.createElement("div");

        botMsg.className = "bot-message";

        botMsg.innerText =
        "⚠️ No pude conectarme con el servidor.";

        messages.appendChild(botMsg);

    });

}