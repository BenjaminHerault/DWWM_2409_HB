let dateValider = document.querySelector("#date");
let calculValider = document.querySelector("#calcul");
let formDateValider = document.querySelector("#formDate");
let main = document.querySelector("#main");
let test = false;

let monTexte = document.createElement("p");
monTexte.textContent = "Sélectionnez une date dans le passé.";
formDateValider.appendChild(monTexte);

   // document.querySelectorAll("hr").forEach(element => {
   // element.remove();});    

function voirInfo(){
    let tabDate = dateValider.value.split("-");
    let jours = tabDate[2].split("T");
    let partieJour = jours[0];
    monTexte.innerHTML = "Vous êtes né le <span style='color:blue;'><span style='font-weight:bold;'>" + partieJour + "/"+tabDate[1]+"/"+tabDate[0]+ "</span></span> à <span style='color:blue;'><span style='font-weight:bold;'>"+jours[1]+ ":0 </span></span>"+ (new Date(dateValider.value)).getSeconds();
    formDateValider.appendChild(monTexte);
}
 
const voirTemps = () => {
    if (Date.now() < new Date(dateValider.value)){
        monTexte.textContent = "Vous êtes né dans le futur.";
        formDateValider.appendChild(monTexte);
    }
    else{
        let age = Date.now() - new Date(dateValider.value);
        let ageEnAnnees = Math.floor(age / (1000 * 60 * 60 * 24 * 365.25));
        let monAge = document.createElement("p");
        monAge.textContent = "Vous avez " + ageEnAnnees + " ans.";
        formDateValider.appendChild(monAge);
    }
};

calculValider.addEventListener("click",function() {
    if (test === false){
        let ligne = document.createElement("hr");
        formDateValider.appendChild(ligne);
        let ligne2 = document.createElement("hr");
        main.appendChild(ligne2);
    }
    test = true; 
        voirInfo();
        voirTemps();
 } );

