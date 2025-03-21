const monBody = document.querySelector("body");
const caseDispo = true;


// creaction d'une fonction rajouter
function ajouterUneCelluleDonnee(ligne, cord_X, cord_Y){
    let celluleInfo = ligne.insertCell();
    let idLigne = cord_X +"-"+ cord_Y;
    celluleInfo.id = idLigne;
    celluleInfo.dataset.x = cord_X; 
    celluleInfo.dataset.y = cord_Y;
    celluleInfo.textContent = idLigne;
    return celluleInfo;
};

// creaction du tableau
const monTableau = document.createElement("table");
monBody.appendChild(monTableau);

// creation du thead
const monThead = monTableau.createTHead();

// creation de Tr
const ligneThead = monThead.insertRow();

// creation du tbody
const monTbody = monTableau.createTBody();

for (let i = 0; i < 7; i++) {
    const ligneTbody = monTbody.insertRow();

    for (let j = 0; j < 7; j++) {
        ajouterUneCelluleDonnee(ligneTbody, i, j);

    }  
}
monTableau.addEventListener( "click", function(event){
    positionnement(event);
});

const positionnement = (event) => {
    console.log(event.target.dataset.x+" je suis la ligne (x)");
    console.log(event.target.dataset.y+ " je suis la colonne (y)");
    console.log(event.target.id);
    // target = fait référence à l'élément qui a déclenché l'événement.
    event.target.id = "unJeton";

    if(event.target.dataset.x && event.target.dataset.y ){
        console.log(event.target.dataset.x +" et "+ event.target.dataset.y );
    }

    // if (event.target.id === "unJeton") {
    //     console.log("je suis une case pleine");
    // }
    // else {
    //     console.log("je suis une case vide");
    // }
};




/*
for (let i = 7; i > 0; i--) {
    const ligneTbody = monTbody.insertRow();

    for (let j = 7; j > 0; j--) {
        ajouterUneCelluleDonnee(ligneTbody, i, j);

    }  
}*/


