const prenomVerif = document.querySelector("#prenom");
const ageVerif = document.querySelector("#age");
const validerVerif = document.querySelector("#boutonValider");
const viderVerif = document.querySelector("#boutonVider");
const messageVerif = document.querySelector("#texteInfo");
const mainStyle = document.querySelector("main");

let texte = "Compléter/corriger le Formulaire.";

const regex = /^[a-zA-Z-]+$/g;

const voirTexte = () => {
    messageVerif.innerHTML = texte;
}

const cssTest = () => {
    mainStyle.style.backgroundColor = "red";
}



// function voirTexte(){ 
//     messageVerif.innerHTML = texte;
// }
const onVide = () =>{
    prenomVerif.value="";
    ageVerif.value="";
    voirTexte();
}

const maRetraite = () => {
    if(ageVerif.value < 64){
        let annee = 64 - ageVerif.value;
        return "Il vous reste "+annee+" année(s) avant la retraite";
    }
   else if (ageVerif.value>64){
         let annee = ageVerif.value - 64;
         return "Vous êtes à la retraite depuis "+annee+" année(s)";
    }
    else{
        return "Vous prenez votre retraite cette année !";
    }
}

const ageMajorite = () => {
    if(ageVerif.value < 18) {
        return "Vous êtes mineur";
    }
    else{
        return "Vous êtes majeur";
    }
}

const voirInfo = () => {
    if(prenomVerif.value.match(regex) && ageVerif.value != "" && ageVerif.value > 0){
        messageVerif.innerHTML = "Bonjour " + prenomVerif.value + ", votre âge est " + ageVerif.value + "<br><br>"+ ageMajorite()+ "<br><br>" +  maRetraite();
    }
    else{
        voirTexte();
    }
}

// avec la balice button en html qu'on utilise le preventDefault()
// validerVerif.addEventListener("click",(e) => {
//     e.preventDefault()});
// validerVerif.addEventListener("click",voirTexte);
validerVerif.addEventListener("click",voirInfo);
viderVerif.addEventListener("click",onVide);
mainStyle.addEventListener("",cssTest);

