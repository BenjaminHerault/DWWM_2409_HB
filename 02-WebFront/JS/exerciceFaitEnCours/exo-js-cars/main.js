const voiture = [];
const voitureValide = document.getElementById("validate");
const maVoiture = document.getElementById("carName");
// const voitureTrouvee = false;

fetch("./data/cars.json").then(response => response.json()).then(data => {
    for(let i = 0; i < data.length; i++){
        voiture.push(data[i].car_name);
    }

voitureValide.addEventListener("click", function(){
    event.preventDefault();
    console.log("un truc");
    let voitureTrouvee = false;
    for(let i = 0; i < data.length; i++){
        if(voiture[i]=== maVoiture.value){
            lesInfoVoiture(data[i]);
            console.log("Voiture trouvée");
            voitureTrouvee = true;
            break
        }

    };
    if(voitureTrouvee===false){
        console.log("Aucune voiture ne correspond à votre recherche");
    }
    });
}).catch(error => console.error(error));


function lesInfoVoiture(data){
    let idVoicture = document.createElement("p");
    let nomVoiture = document.createElement("p");
    let anneeVoicture = document.createElement("p");
    let paysOrigineVoiture = document.createElement("p");

    for(let i = 0; i < data.length; i++){
        idVoicture.textContent = "ID: " + data[i].car_id;
        nomVoiture.textContent = "Nom: " + data[i].car_name;
        anneeVoicture.textContent = "Année: " + data[i].car_model;
        paysOrigineVoiture.textContent = "Pays d'origine: " + data[i].car_origin;
    }
}
