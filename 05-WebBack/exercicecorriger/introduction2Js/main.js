// const text = je l'apple comme je veux 
// document.querySelector('.text') fait refference au html
//const text(on nom dans le js) = document.querySelector("#texteTaille (et nome dans le html)")
const textValue = document.querySelector("#texteTaille");
const btnTaille = document.querySelector("#boutonTaille");
const btnDimi = document.querySelector("#boutonDimi");
const conteur   = document.querySelector("#numeroTaille");
const nombreValue = document.querySelector("#saisieTaille");

let taille = 16;
conteur.innerHTML = taille

function ajuster(taille){
    conteur.innerHTML = taille
    textValue.style.fontSize = taille + 'px'
}
function plus(){
    if (taille <= 47){
        taille++;
        ajuster(taille)
    }
    else{
        taille = 16;
        ajuster(taille) 
    }
}
function moin(){
    if(taille > 8){
        taille--;
        ajuster(taille)
    }
    else{
        taille = 16;
        ajuster(taille)   
    }
}
function changer(e){
    const nouvelleTaille = parseInt(e.target.value);
    if(nouvelleTaille >= 8 && nouvelleTaille <= 47){
        taille = nouvelleTaille;
        ajuster(taille)
    }
    else{
        taille = 16;
        ajuster(taille)
    }

}
btnTaille.addEventListener("click", plus);
btnDimi.addEventListener("click", moin);
nombreValue.addEventListener("input", changer);
