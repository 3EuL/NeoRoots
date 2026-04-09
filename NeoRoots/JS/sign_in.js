document.addEventListener("DOMContentLoaded", function(){

    const form = document.querySelector("#signInForm");

   
    function showToast(message, type = "success"){

        const container = document.getElementById("toastContainer");

        const toast = document.createElement("div");
        toast.classList.add("toast", type);
        toast.textContent = message;

        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = "0";
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

   
    form.addEventListener("submit", function(e){
        e.preventDefault();

        const formData = new FormData(form);
        formData.append("registrate", "1");

        fetch("/NeoRoots/BackEnd/login_registro.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            console.log("RESPUESTA DEL SERVIDOR:", data);
            
            data = data.trim();


            if(data === "ok"){
                showToast("Registro exitoso", "success");

                setTimeout(() => {
                    window.location.href = "Login.php";
                }, 1500);
            }

            else if(data.startsWith("error:")){
                showToast(data.replace("error:", ""), "error");
            }

            else{
                showToast("Error inesperado", "error");
            }

        })
        .catch(() => {
            showToast("Error de conexión", "error");
        });

    });

});