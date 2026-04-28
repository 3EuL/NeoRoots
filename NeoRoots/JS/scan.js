const contenedores = document.querySelectorAll('.contenedor');
const noti = document.getElementById('notificacion');

contenedores.forEach(c => {
  c.addEventListener('click', () => {

    // puntos
    const puntos = c.dataset.points;

    // hora exacta
    const ahora = new Date();
    const hora = ahora.toLocaleTimeString();

    // mensaje
    const mensaje = `+${puntos} puntos | ${hora}`;

    // animación click
    c.style.transform = "scale(0.95)";
    setTimeout(() => {
      c.style.transform = "scale(1)";
    }, 150);

    // mostrar notificación
    noti.textContent = mensaje;
    noti.classList.add('show');

    setTimeout(() => {
      noti.classList.remove('show');
    }, 3000);

  });
});