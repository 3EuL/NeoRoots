const contenedores =
document.querySelectorAll(".contenedor");

const resultado =
document.getElementById("resultado");

const noti =
document.getElementById("notificacion");

const camara =
document.getElementById("camara");

const estadoScan =
document.getElementById("estadoScan");

const puntosUsuario =
document.getElementById("puntosUsuario");


const WASTE_IDS = {
    "bottle": 1,
    "book": 2,
    "cup": 3,
    "cell phone": 4,
    "wine glass": 5
};


camara.src = "http://127.0.0.1:5000/video";


let contenedorSeleccionado = null;
let containerId = null;
let ultimoObjeto = null;
let servoActivado = false;
let ultimoObjetoPremiado = null;
let puedePremiar = true;
let consultando = false;
let tiempoSinObjeto = 0;
let timeoutInactividad = null;

contenedores.forEach(c => {

    c.addEventListener("click", () => {

        contenedores.forEach(x => x.classList.remove("activo"));
        c.classList.add("activo");

        clearTimeout(timeoutInactividad);

            timeoutInactividad = setTimeout(() => {

            resetResultado();
            resetContenedores();

        }, 5000);

        const titulo =
            c.querySelector("h2").innerText;

        if (titulo.includes("Plástico")) {
            contenedorSeleccionado = "plastic";
            containerId = 18;
        }

        else if (titulo.includes("Papel")) {
            contenedorSeleccionado = "paper";
            containerId = 16;
        }

        else if (titulo.includes("Vidrio")) {
            contenedorSeleccionado = "glass";
            containerId = 19;
        }
    });
});

function resetContenedores(){

    contenedores.forEach(c => {
        c.classList.remove("activo");
    });

    contenedorSeleccionado = null;
    containerId = null;
}

function resetResultado() {

    resultado.className = "resultado";

    resultado.innerHTML = `
        <h2 style="color:#999;">Esperando escaneo...</h2>
        <p style="color:#aaa;">
            Acerca un objeto a la cámara
        </p>
    `;
}


function mostrarAnimacionPuntos(puntos) {

    const anim =
        document.getElementById("animacionPuntos");

    if (!anim) return;

    anim.innerText = `+${puntos} XP`;

    anim.classList.remove("show");

    void anim.offsetWidth;

    anim.classList.add("show");
}


async function enviarPuntos(puntos, wasteId) {

    const formData = new FormData();

    formData.append("points", puntos);
    formData.append("container_id", containerId);
    formData.append("waste_id", wasteId);

    try {

        const respuesta = await fetch(
            "../BackEnd/add_points.php",
            {
                method: "POST",
                body: formData
            }
        );

        const data = await respuesta.json();

        console.log("Respuesta backend:", data);

    } catch (error) {
        console.log("Error enviando puntos:", error);
    }
}


async function actualizarDeteccion() {


    if (consultando) return;

    consultando = true;

    

    try {

        const respuesta =
            await fetch("http://127.0.0.1:5000/ultima_deteccion");

        const data = await respuesta.json();

        if(ultimoObjeto !== data.object){
            servoActivado = false;
        }

        ultimoObjeto = data.object;

        if(data.object === "ninguno"){

            estadoScan.innerText =
            "🔍 Buscando objetos...";

            tiempoSinObjeto += 600;

        if(
            contenedorSeleccionado &&
            tiempoSinObjeto >= 5000
        ){

            resetResultado();
            resetContenedores();

            contenedorSeleccionado = null;
            containerId = null;

            tiempoSinObjeto = 0;
        }

        return;
    }

        let estado = "Seleccione un contenedor";
        let clase = "";

        
        if (contenedorSeleccionado) {

            if (data.material === contenedorSeleccionado) {

            estado = "✓ RECICLAJE CORRECTO";
            clase = "correcto";

            if (!servoActivado) {

                servoActivado = true;

                fetch("http://127.0.0.1:5000/mover_servo")
                    .catch(error => console.log(error));

                setTimeout(() => {

                    resetContenedores();

                    contenedorSeleccionado = null;

                    containerId = null;

                }, 2500);
            }
            

            const wasteId = WASTE_IDS[data.object];

                if (
                    puedePremiar &&
                    wasteId &&
                    ultimoObjetoPremiado !== data.object
                ) {

                    puedePremiar = false;
                    ultimoObjetoPremiado = data.object;

                    enviarPuntos(data.points, wasteId);
                    mostrarAnimacionPuntos(data.points);

                    setTimeout(() => {

                        resetResultado();
                        resetContenedores();

                        contenedorSeleccionado = null;
                        containerId = null;

                    }, 2500);

                    setTimeout(() => {
                        puedePremiar = true;
                    }, 4000);
                }

            } else {

                estado = "✗ CONTENEDOR INCORRECTO";
                clase = "incorrecto";
                setTimeout(() => {

                    resetResultado();
                    resetContenedores();

                    contenedorSeleccionado = null;
                    containerId = null;

                }, 2500);
            }
        }

        
        let html = `
            <p><strong>Objeto:</strong> ${data.object}</p>
            <p><strong>Confianza:</strong> ${data.confidence}</p>
        `;

        if (contenedorSeleccionado) {

            html += `
                <h2>${estado}</h2>
                <p><strong>Puntos:</strong> ${data.points}</p>
            `;
        }

        resultado.className = "resultado " + clase;
        resultado.innerHTML = html;

    } catch (error) {
        console.log(error);
    } finally {
        consultando = false;
    }
}


async function actualizarPuntos() {

    try {

        const res =
            await fetch("../BackEnd/get_points.php");

        const data = await res.json();

        if (data.success) {

            puntosUsuario.innerText =
                data.total;
        }

    } catch (e) {
        console.log(e);
    }
}


setInterval(actualizarDeteccion, 600);
setInterval(actualizarPuntos, 2000);