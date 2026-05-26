const toggle = document.getElementById("chatbot-toggle");
const container = document.getElementById("chatbot-container");
const closeBtn = document.getElementById("close-chat");
const sendBtn = document.getElementById("send-btn");
const input = document.getElementById("chatbot-input");
const messages = document.getElementById("chatbot-messages");

// =========================
// ABRIR / CERRAR CHAT
// =========================

toggle.onclick = () => {
  container.style.display = "flex";
};

closeBtn.onclick = () => {
  container.style.display = "none";
};

// =========================
// ENVIAR MENSAJE
// =========================

sendBtn.onclick = enviar;

input.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    enviar();
  }
});

// =========================
// FUNCIÓN PRINCIPAL
// =========================

async function enviar() {

  const texto = input.value.trim();

  if (!texto) return;

  // =========================
  // MENSAJE USUARIO
  // =========================

  agregarMensaje(texto, "user-message");

  input.value = "";

  // =========================
  // EFECTO ESCRIBIENDO...
  // =========================

  const typing = agregarMensaje(
    "🌱 EcoBot está escribiendo...",
    "bot-message"
  );

  try {

    const res = await fetch("chat.php", {

      method: "POST",

      headers: {
        "Content-Type": "application/json"
      },

      body: JSON.stringify({
        mensaje: texto
      })

    });

    // =========================
    // ERROR HTTP
    // =========================

    if (!res.ok) {
      throw new Error("Error del servidor");
    }

    const data = await res.json();

    // quitar "escribiendo..."
    typing.remove();

    // =========================
    // RESPUESTA BOT
    // =========================

    let respuesta =
      data.respuesta || "No pude responder.";

    // =========================
    // FORMATO BONITO
    // =========================

    respuesta = respuesta

      // negritas markdown
      .replace(/\*\*(.*?)\*\*/g, "<b>$1</b>")

      // saltos de línea
      .replace(/\n/g, "<br>")

      // listas
      .replace(/^- (.*$)/gim, "• $1");

    agregarMensajeHTML(
      respuesta,
      "bot-message"
    );

  } catch (error) {

    typing.remove();

    agregarMensaje(
      "❌ Error de conexión con el servidor.",
      "bot-message"
    );

    console.error(error);

  }

}

// =========================
// CREAR MENSAJE NORMAL
// =========================

function agregarMensaje(texto, clase) {

  const div = document.createElement("div");

  div.className = clase;

  div.innerText = texto;

  messages.appendChild(div);

  scrollAbajo();

  return div;

}

// =========================
// CREAR MENSAJE HTML
// =========================

function agregarMensajeHTML(html, clase) {

  const div = document.createElement("div");

  div.className = clase;

  div.innerHTML = html;

  messages.appendChild(div);

  scrollAbajo();

}

// =========================
// AUTO SCROLL
// =========================

function scrollAbajo() {

  messages.scrollTop =
    messages.scrollHeight;

}