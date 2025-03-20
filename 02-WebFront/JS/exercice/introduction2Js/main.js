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
    nombreValue.value = taille;
}
function plus(){
    if (taille <= 47){
        taille++;
        ajuster(taille);
    }
    else{
        taille = 16;
        ajuster(taille); 
    }
}
function moin(){
    if(taille > 8){
        taille--;
        ajuster(taille);
    }
    else{
        taille = 16;
        ajuster(taille);   
    }
}
function changer(e){
    const nouvelleTaille = parseInt(e.target.value);
    if(nouvelleTaille >= 8 && nouvelleTaille <= 48){
        taille = nouvelleTaille;
        ajuster(taille);
        nombreValue.value = taille;
    }
    else{
        taille = 16;
        ajuster(taille);
        nombreValue.value = taille;
    }
}
btnTaille.addEventListener("click", plus);
btnDimi.addEventListener("click", moin);
nombreValue.addEventListener("blur", changer);
