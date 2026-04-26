document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector("#loginForm");

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("../BackEnd/procesador_login.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            console.log("RESPUESTA DEL SERVIDOR:", data);

            if (data.includes("success_user")) {

                showToast("Inicio de sesión exitoso", "success");

                setTimeout(() => {
                    window.location.href = "../FrontEnd/Hub.php";
                }, 1500);

            }else if (data.includes("success_admin")) {

                showToast("Bienvenido de vuelta, Administador", "success");

                setTimeout(() => {
                    window.location.href = "../Dashboard/index.html";
                }, 1500);

            } else if (data.includes("error_pass")) {

                showToast("Contraseña incorrecta", "error");

            } else if (data.includes("error_user")) {

                showToast("Usuario o correo no encontrado", "error");

            } else if (data.includes("error_empty")) {

                showToast("Debes completar ambos campos", "error");    

            }
             else {

                showToast("Error inesperado", "error");
            }
        })
        .catch(() => {
            showToast("Error del servidor", "error");
        });
    });

});



function showToast(message, type = "success") {
    const container = document.getElementById("toastContainer");

    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("hide");
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}