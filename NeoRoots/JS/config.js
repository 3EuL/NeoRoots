document.addEventListener("DOMContentLoaded", function(){

    
    const form = document.getElementById("configForm");
    const btn = form.querySelector("button[type='submit']");
    
    const upload = document.getElementById("pfpUpload");
    const profilePic = document.getElementById("profilePic");
    
    const togglePassBtn = document.getElementById("togglePass");
    const passwordSection = document.getElementById("passwordSection");
    
    let passVisible = false;
    
    
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
    
    
    togglePassBtn.addEventListener("click", () => {
    
        passVisible = !passVisible;
    
        if(passVisible){
            passwordSection.classList.remove("hidden");
            togglePassBtn.textContent = "Cancelar cambio de contraseña";
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
    
        const pass = form.querySelector("input[name='pass']").value;
        const confirm = form.querySelector("input[name='confirm_pass']").value;
    
      
if(passVisible){

    if(pass === "" || confirm === ""){
        showToast("Debes completar ambos campos de contraseña", "error");
        return;
    }

    if(pass !== confirm){
        showToast("Las contraseñas no coinciden", "error");
        return;
    }
}


if(!passVisible){
    formData.delete("pass");
    formData.delete("confirm_pass");
}
        
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
                showToast("Cambios guardados", "success");
            
                
                if(upload.files[0]){
                    const nuevaImagen = URL.createObjectURL(upload.files[0]);
                    profilePic.src = nuevaImagen;
                }
            
                
                form.querySelector("input[name='pass']").value = "";
                form.querySelector("input[name='confirm_pass']").value = "";
            
                passwordSection.classList.add("hidden");
                togglePassBtn.textContent = "Cambiar contraseña";
                passVisible = false;
            }
    
            
            else if(data.startsWith("error:")){
                const mensaje = data.replace("error:", "");
                showToast(mensaje, "error");
            }
    
            
            else{
                showToast("Error inesperado", "error");
            }
    
        })
        .catch(() => {
            showToast("Error de conexión", "error");
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = "Guardar cambios";
        });
    });
    
});