let dateValider = document.querySelector("#date");
let calculValider = document.querySelector("#calcul");
let formDateValider = document.querySelector("#formDate");
let main = document.querySelector("#main");
let trai = false;
let monTexte = document.createElement("div");

monTexte.textContent = "Sélectionnez une date dans le passé.";
formDateValider.appendChild(monTexte);   

   function voirInfo(){
    let tabDate = dateValider.value.split("-");
    let jours = tabDate[2].split("T");
    let partieJour = jours[0];
    let secondes = (new Date(dateValider.value)).getSeconds().toString().padStart(2, '0');
    monTexte.innerHTML = "Vous êtes né le <span style='color:blue; font-weight:bold;'>" + partieJour + "/" + tabDate[1] + "/" + tabDate[0] + "</span> à <span style='color:blue; font-weight:bold;'>" + jours[1] + "</span>:<span style='color:blue; font-weight:bold;'>" + secondes + "</span>";
    formDateValider.appendChild(monTexte);
}
const voirTemps = () => {
    if (Date.now() < new Date(dateValider.value)){
        monTexte.textContent = "Vous êtes né dans le futur.";
        formDateValider.appendChild(monTexte);
    }
    else{
        document.querySelectorAll("p").forEach(element => {
        element.remove();
    });
        let age = Date.now() - new Date(dateValider.value);
        let ageEnAnnees = Math.floor(age / (1000 * 60 * 60 * 24 * 365.25));
        let monAge = document.createElement("p");
        monAge.textContent = "Il s'est écoulé " + ageEnAnnees + " années depuis votre naissance";
        formDateValider.appendChild(monAge);
    }
};

const voirSigneAstrologique = () => {
    if ("#signeAstrologique" === null){
        let signeAstrologique = document.createElement("div");
        signeAstrologique.setAttribute("id", "signeAstrologique");
        signeAstrologique.textContent = "Votre signe astrologique est : "+ signeAstrologiqueNom(new Date(dateValider.value));
        main.appendChild(signeAstrologique);
    };
      
    
};



const signeAstrologiqueNom = (date) => {
   const jour = date.getDate();
   const mois = date.getMonth() + 1;
   if((mois === 12 && jour >= 22) || (mois === 1 && jour <= 19)){
        return "Capricorne";
   }
   else if (mois === 1 && jour >= 20 || mois === 2 && jour <= 18){
        return "Verseau";
   }
   else if (mois === 2 && jour >= 19 || mois === 3 && jour <= 20){
        return "Poisson";
   };
};


calculValider.addEventListener("click",function() {
    if (trai === false){
        let l document.createElement("hr");
        formDateValider.appendChild(ligne);
        ligne.style.border = "1px solid ";
        let ligne2 = document.createElement("hr");
        main.appendChild(ligne2); 
        ligne2.style.border = "1px solid";
    }

    trai = true; 
        voirInfo();
        voirTemps();
        voirSigneAstrologique();    
 } );

