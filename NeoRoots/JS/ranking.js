async function cargarRanking(){

    try{

        const res =
        await fetch(
            "../BackEnd/get_ranking.php"
        );

        const usuarios =
        await res.json();

        const container =
        document.getElementById(
            "rankingContainer"
        );

        container.innerHTML = "";

        usuarios.forEach((u,index)=>{

            let clase = "";
            let clasePuntos = "points";

            if(index === 0){
                clase = "top1";
                clasePuntos = "points_top1";
            }

            else if(index === 1){
                clase = "top2";
                clasePuntos = "points_top2";
            }

            else if(index === 2){
                clase = "top3";
                clasePuntos = "points_top3";
            }

            let foto;

            if(
                u.pfp &&
                u.pfp !== ""
            ){

                foto = 
                "../ASSETS/ProfilePictures/" 
                + u.pfp;

            }else{

                foto =
                "../ASSETS/ProfilePictures/default.png";
            }

            container.innerHTML += `

                <div class="player ${clase}">

                    <div class="position">
                        #${index + 1}
                    </div>

                    <div class="info">

                        <img
                            src="${foto}"
                            alt="Perfil"
                        >

                        <div class="name">
                            ${u.user}
                        </div>

                    </div>

                    <div class="${clasePuntos}">
                        ${u.total_points} pts
                    </div>

                </div>

            `;
        });

    }catch(error){

        console.log(error);
    }
}

cargarRanking();