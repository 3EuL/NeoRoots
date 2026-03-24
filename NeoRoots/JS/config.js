document.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById("configForm");
    const msg = document.getElementById("saveMsg");
    const errorMsg = document.getElementById("errorMsg");
    const btn = form.querySelector("button[type='submit']");
    
    const upload = document.getElementById("pfpUpload");
    const profilePic = document.getElementById("profilePic");
    
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
    MOSTRAR/OCULTAR PASSWORD
    ========================= */
    const togglePassBtn = document.getElementById("togglePass");
    const passwordSection = document.getElementById("passwordSection");
    
    let passVisible = false;
    
    togglePassBtn.addEventListener("click", () => {
    
        passVisible = !passVisible;
    
        if(passVisible){
            passwordSection.classList.remove("hidden");
            togglePassBtn.textContent = "Cancelar cambio";
        }else{
            passwordSection.classList.add("hidden");
            togglePassBtn.textContent = "Cambiar contraseña";
    
            form.querySelector("input[name='pass']").value = "";
            form.querySelector("input[name='confirm_pass']").value = "";
        }
    
    });
    
  
    form.addEventListener("submit", function(e){
    e.preventDefault();
    
    const formData = new FormData(form);
    
    msg.classList.add("hidden");
    errorMsg.classList.add("hidden");
    
    btn.disabled = true;
    btn.textContent = "Guardando...";
    
    fetch("../procesador_config.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
    
        data = data.trim();
    
        if(data === "ok"){
    
            msg.classList.remove("hidden");
    
            setTimeout(() => {
                location.reload();
            }, 1500);
    
        }else if(data.startsWith("error:")){
    
            errorMsg.textContent = data.replace("error:", "");
            errorMsg.classList.remove("hidden");
    
        }else{
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