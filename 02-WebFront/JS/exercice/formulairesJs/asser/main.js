const prenomVerif = document.querySelector("#prenom");
const ageVerif = document.querySelector("#age");
const validerVerif = document.querySelector("#boutonValider");
const viderVerif = document.querySelector("#boutonVider");
const messageVerif = document.querySelector("#texteInfo");



let texte = "Compléter/corriger le Formulaire.";
const regex = /^[a-zA-Z-]+$/g;

const voirTexte = () => {
    messageVerif.innerHTML = texte;
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
    if(ageVerif.value == 64){
        return "Vous prenez votre retraite cette année !";
    }
   else if (ageVerif.value>64){
         let annee = ageVerif.value - 64;
         return "Vous êtes à la retraite depuis "+annee+" année(s)";
    }
    else{
        let annee = 64 - ageVerif.value;
        return "Il vous reste <span style='color:blue;'><span style='font-weight:bold;'>"+annee+"</span></span> année(s) avant la retraite";
    }
}

const ageMajorite = () => {
    if(ageVerif.value < 18) {
        return "Vous êtes<span style='color:blue;'><span style='font-weight:bold;'> " +"mineur."+ "</span></span>";
    }
    else{
        return "Vous êtes <span style='color:blue;'><span style='font-weight:bold;' >"+"majeur."+ "</span></span>";
    }
}

const voirInfo = () => {
    if(prenomVerif.value.match(regex) && ageVerif.value != "" && ageVerif.value > 0){
        messageVerif.innerHTML = "Bonjour <span style='color:blue;'><span style='font-weight:bold;'> " + prenomVerif.value + "</span></span>, votre âge est <span style='color:blue;'><span style='font-weight:bold;'>" + ageVerif.value + "</span></span><br><br>"+ ageMajorite()+ "<br><br>" +  maRetraite();
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


