let dateValider = document.querySelector("#date");
let calculValider = document.querySelector("#calcul");
let formDateValider = document.querySelector("#formDate");
let date = new Date();

let monTexte = document.createElement("p");
monTexte.textContent = "Sélectionnez une date dans le passé.";
formDateValider.appendChild(monTexte);

// let ligne = document.createElement("hr");
// document.body.main.div.appendChild(ligne);

function voirInfo(){

    let tabDate = dateValider.value.split("-");
    let jours = tabDate[2].split("T");
    let partieJour = jours[0];
    monTexte.textContent = "Vous êtes né le " + partieJour + "/"+tabDate[1]+"/"+tabDate[0]+ " à "+jours[1]+ ":0"+ (new Date(dateValider.value)).getSeconds();
    formDateValider.appendChild(monTexte);
    console.log("non pas sa ");
}

const voirTemps = () => {
    
};
console.log();
calculValider.addEventListener("click", voirInfo);