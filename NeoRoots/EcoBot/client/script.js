const toggle = document.getElementById("chatbot-toggle");
const container = document.getElementById("chatbot-container");
const closeBtn = document.getElementById("close-chat");
const sendBtn = document.getElementById("send-btn");
const input = document.getElementById("chatbot-input");
const messages = document.getElementById("chatbot-messages");

// abrir/cerrar
toggle.onclick = () => container.style.display = "flex";
closeBtn.onclick = () => container.style.display = "none";

// enviar mensaje
sendBtn.onclick = enviar;
input.addEventListener("keypress", e => {
  if (e.key === "Enter") enviar();
});

async function enviar() {
  const texto = input.value.trim();
  if (!texto) return;

  // mensaje usuario
  const userMsg = document.createElement("div");
  userMsg.className = "user-message";
  userMsg.innerText = texto;
  messages.appendChild(userMsg);

  input.value = "";

  // 🔥 indicador "escribiendo..."
  const typing = document.createElement("div");
  typing.className = "bot-message";
  typing.innerText = "Escribiendo...";
  messages.appendChild(typing);
  messages.scrollTop = messages.scrollHeight;

  try {
    const res = await fetch("chat.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ mensaje: texto })
    });

    // ⚠️ verificar si hay error HTTP
    if (!res.ok) throw new Error("Error en servidor");

    const data = await res.json();

    // quitar "escribiendo..."
    typing.remove();

    const botMsg = document.createElement("div");
    botMsg.className = "bot-message";
    botMsg.innerText = data.respuesta || "Sin respuesta";

    messages.appendChild(botMsg);
    messages.scrollTop = messages.scrollHeight;

  } catch (error) {
    typing.remove();

    const errorMsg = document.createElement("div");
    errorMsg.className = "bot-message";
    errorMsg.innerText = "Error de conexión con el servidor";
    messages.appendChild(errorMsg);
  }
}