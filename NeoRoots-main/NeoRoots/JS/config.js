document.addEventListener("DOMContentLoaded", function(){

    const upload = document.getElementById("pfpUpload");
    const profilePic = document.getElementById("profilePic");
    const msg = document.getElementById("saveMsg");
    const errorMsg = document.getElementById("errorMsg");
    const form = document.getElementById("configForm");
    const btn = form.querySelector("button");
    
    /* =========================
    PREVISUALIZAR IMAGEN
    ========================= */
    upload.addEventListener("change", function(){
    
   
    const file = this.files[0];
    
    if(file){
        const reader = new FileReader();
    
        reader.onload = function(e){
            profilePic.src = e.target.result;
        }
    
        reader.readAsDataURL(file);
    }
   
    
    });
    
    /* =========================
    ENVÍO AJAX DEL FORMULARIO
    ========================= */
    form.addEventListener("submit", function(e){
    e.preventDefault();
    
    
    const formData = new FormData(form);
    
    // reset mensajes
    errorMsg.classList.add("hidden");
    msg.classList.add("hidden");
    
    // estado botón
    btn.disabled = true;
    btn.textContent = "Guardando...";
    
    fetch("../procesador_config.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
    
        data = data.trim();
    
        /* ===== ÉXITO ===== */
        if(data === "ok"){
    
            msg.classList.remove("hidden");
    
            setTimeout(() => {
                msg.style.opacity = "0";
    
                setTimeout(() => {
                    location.reload(); // 🔥 recarga solo si todo sale bien
                }, 500);
    
            }, 2000);
    
        }
    
        /* ===== ERRORES PERSONALIZADOS ===== */
        else if(data.startsWith("error:")){
    
            const mensaje = data.replace("error:", "");
    
            errorMsg.textContent = mensaje;
            errorMsg.classList.remove("hidden");
    
            // limpiar contraseñas
            form.querySelector("input[name='pass']").value = "";
            form.querySelector("input[name='confirm_pass']").value = "";
    
        }
    
        /* ===== ERROR DESCONOCIDO ===== */
        else{
            alert("Error inesperado");
        }
    
    })
    .catch(() => {
        alert("Error de conexión");
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = "Guardar cambios";
    });
    
    
    });
    
    });
    