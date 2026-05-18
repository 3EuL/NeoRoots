const contenedores = document.querySelectorAll('.contenedor');
const noti = document.getElementById('notificacion');

const CAM_URL = "http://192.168.4.1/capture";

contenedores.forEach(c => {
  c.addEventListener('click', async () => {

    const puntos = c.dataset.points;
    const ahora = new Date();
    const hora = ahora.toLocaleTimeString();

    // animación click
    c.style.transform = "scale(0.95)";
    setTimeout(() => {
      c.style.transform = "scale(1)";
    }, 150);

    try {
      // tomar foto desde ESP32
      const imgURL = CAM_URL + "?t=" + new Date().getTime();

      noti.innerHTML = `
        +${puntos} puntos | ${hora}<br>
        <img src="${imgURL}" width="170" style="margin-top:10px; border-radius:10px;">
      `;

    } catch (error) {
      noti.innerHTML = `+${puntos} puntos | ${hora}<br>Error al tomar foto`;
      console.error(error);
    }

    noti.classList.add('show');

    setTimeout(() => {
      noti.classList.remove('show');
    }, 5000);

  });
});

const camara = document.getElementById("camara");

setInterval(() => {
  camara.src = "http://192.168.4.1/capture?t=" + new Date().getTime();
}, 100);