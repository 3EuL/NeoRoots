const contenedores = document.querySelectorAll('.contenedor');
const noti = document.getElementById('notificacion');

const CAM_CAPTURE = "http://neoroots-cam.local/capture";
const CAM_STREAM = "http://neoroots-cam.local/stream";

// ========================
// STREAM EN VIVO
// ========================
const camara = document.getElementById("camara");

camara.src = CAM_STREAM;

// ========================
// CLICK CONTENEDORES
// ========================
contenedores.forEach(c => {

  c.addEventListener('click', () => {

    const puntos = c.dataset.points;

    const ahora = new Date();
    const hora = ahora.toLocaleTimeString();

    // evitar cache
    const imgURL =
      CAM_CAPTURE + "?t=" + new Date().getTime();

    // animación
    c.style.transform = "scale(0.95)";

    setTimeout(() => {
      c.style.transform = "scale(1)";
    }, 150);

    // popup
    noti.innerHTML = `
      +${puntos} puntos | ${hora}<br>
      <img src="${imgURL}"
           width="180"
           style="
             margin-top:10px;
             border-radius:10px;
           ">
    `;

    noti.classList.add('show');

    setTimeout(() => {
      noti.classList.remove('show');
    }, 5000);

  });

});