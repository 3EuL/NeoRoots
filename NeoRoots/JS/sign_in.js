document.addEventListener("DOMContentLoaded", function(){

    const form = document.querySelector("#signInForm");

    /* =========================
    TOAST
    ========================= */
   function showToast(message, type = "success") {
    const container = document.getElementById("toastContainer");

    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

 
    form.addEventListener("submit", function(e){
        e.preventDefault();

        const formData = new FormData(form);
        formData.append("registrate", "1");

        fetch("../BackEnd/login_registro.php", {
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
                    window.location.href = "../FrontEnd/Login.php";
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