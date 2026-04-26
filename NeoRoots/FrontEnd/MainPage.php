<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/MainPage.css">
    <link rel="shortcut icon" href="../ASSETS/Logos/LogoEmpresa.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">


</head>
<body>
    
    <section id="Home">
        <div class="nav">
            <nav>

            <img src="../ASSETS/Logos/LogoProyecto.png" alt="">

      

             <ul>
                <li><a href="#Home">Inicio</a></li>
                <li><a href="#Nuestra-Mision">Nuestra Misión</a></li>
                <li><a href="#Contacto">Contacto</a></li>
                <li><a href="#Proyectos">Proyecto</a></li>

                
                <li><a href="Login.php" class="Sign-In">Inicio de Sesión</a></li>
                <li><a href="Sign-In.php" class="Sign-In">Registro</a></li>
            </ul>
            
            </nav>
        </div>
            <h1>Bienvenidos</h1>
           

         
            <h2>Únete a nuestra misión y restaura los ecosistemas de nuestro planeta</h2>
            <div class="Link">
                <a href="/Sign-In.php">INICIAR</a>
    
            </div>
    </section>
    
    <section class="about-section" id="Nuestra-Mision">
    <div class="about-container">
        <div class="about-content">
            <h2 class="about-title">NUESTRA MISION</h2>
            
            <div class="about-text-block">
                <p>En NeoRoots, nuestra misión es transformar la recolección de residuos en una fuerza positiva para el medio ambiente y la sociedad. Brindamos un servicio eficiente, seguro y responsable, diseñado para mantener nuestras ciudades limpias y plenas. Más allá de recoger basura, buscamos impulsar la cultura del reciclaje y minimizar el impacto ambiental para construir, juntos, un futuro más verde y sostenible para las próximas generaciones</p>
            </div>

            <a href="#" class="btn-more">MÁS INFORMACIÓN</a>
        </div>

        <div class="about-image">
            <div class="image-wrapper">
            <img src="../images/" alt="Reforestación NeoRoots">
        </div>
        </div>
    </div>
    </section> 


<section class="contact-section" id="Contacto">
    <div class="contact-container">
        
        <!-- Lado Izquierdo: Información -->
        <div class="contact-info">
            <h2>Ponte en Contacto</h2>
            <p>¿Listo para transformar la gestión de residuos en tu comunidad o empresa? Escríbenos y un experto de NeoRoots se comunicará contigo a la brevedad.</p>
            
            <div class="info-details">
                <p><strong>📍 Área de Servicio:</strong> siloe</p>
                <p><strong>📧 Email:</strong> ibito@neoroots.com</p>
                <p><strong>📞 Teléfono:</strong> +57 305 4700795</p>
                <p><strong>🕒 Horario:</strong> Lunes a Viernes - 8:00 AM a 6:00 PM</p>
            </div>
        </div>

        <!-- Lado Derecho: Formulario -->
        <div class="contact-form-container">
            <form action="#" class="contact-form">
                <div class="input-group">
                    <input type="text" placeholder="Tu Nombre Completo" required>
                </div>
                
                <div class="input-group">
                    <input type="email" placeholder="Tu Correo Electrónico" required>
                </div>

                <div class="input-group">
                    <select required>
                        <option value="" disabled selected>¿En qué podemos ayudarte?</option>
                        <option value="residencial">Recolección Residencial</option>
                        <option value="empresas">Servicio para Empresas</option>
                        <option value="reciclaje">Programas de Reciclaje</option>
                        <option value="otro">Otro asunto</option>
                    </select>
                </div>

                <div class="input-group">
                    <textarea placeholder="Escribe tu mensaje aquí..." rows="4" required></textarea>
                </div>

                <button type="submit" class="btn-submit">ENVIAR MENSAJE</button>
            </form>
           
                </div>
            </div>

        </div>

        <div class="Link" style="margin-top: 50px; text-align: center;">
            <a href="Sign-In.php">SÚMATE AL CAMBIO</a>
        </div>

    </div>
    <section class="projects-section" id="Proyectos">
    <div class="projects-container">
        
        <div class="projects-header">
            <h2>Nuestros Proyectos</h2>
            <p>Monitoreamos el impacto real de NeoRoots en la comunidad de Siloé. Transparencia en cada paso hacia la sostenibilidad.</p>
        </div>

        <div class="projects-grid">

            <div class="project-card">
                <span class="status-tag">Planificación</span>
                <h3>Pulmones Verdes</h3>
                <p>Reforestación de zonas recuperadas tras la eliminación de basureros satélites.</p>
                
                <div class="progress-wrapper">
                    <div class="progress-bar" style="width: 15%;"></div>
                </div>
                <div class="progress-info">
                    <span>Progreso: 40%</span>
                    <span>Meta: 200 Árboles</span>
                </div>
            </div>

        </div>

        

    </div>
</section>
        </div>

    </div>



    
</body>
</html>