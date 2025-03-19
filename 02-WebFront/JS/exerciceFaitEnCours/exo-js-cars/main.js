const voiture = [];
const voitureValide = document.getElementById("validate");
const maVoiture = document.getElementById("carName");
const voitureTrouvee = false;
const aucuneInfo = document.createElement("p");
const infoVoiture =  document.createElement("p");
const divResult = document.getElementById("result");

fetch("./data/cars.json").then(response => response.json()).then(data => {
    for(let i = 0; i < data.length; i++){
        voiture.push(data[i].car_name.toLowerCase());
    }
voitureValide.addEventListener("click", function(event){
    event.preventDefault();
    infoVoiture.innerHTML = "";
    maVoiture.value = maVoiture.value.trim().toLowerCase();

    if(maVoiture.value.length < 1){
        AucuneInfoTrouver();
        return;
    }

    let voitureTrouvee = false;
    for(let i = 0; i < data.length; i++){
        if(voiture[i].includes(maVoiture.value)){
            lesInfoVoiture(data[i]);
            voitureTrouvee = true;
        }
    };
    if(voitureTrouvee===false){
        console.log("Aucune voiture ne correspond à votre recherche");
        AucuneInfoTrouver();
        infoVoiture.remove();
    }
    });
}).catch(error => console.error(error));


function AucuneInfoTrouver(){  
    aucuneInfo.id = "aucuneInfo";
    aucuneInfo.textContent = "Aucune voiture ne correspond à votre recherche";
    divResult.appendChild(aucuneInfo);
    setTimeout(() => {
        aucuneInfo.remove();
    }, 5000);
}

function lesInfoVoiture(data){
    infoVoiture.id = "infoVoiture";
    infoVoiture.innerHTML += 
    "<div class=\"resultat\">ID: " + data.car_id + 
    "<br>Nom: " + data.car_name + 
    "<br>Année: " + data.car_model + 
    "<br>Pays d'origine: " + data.car_origin +"</div>";
    divResult.appendChild(infoVoiture);
}
