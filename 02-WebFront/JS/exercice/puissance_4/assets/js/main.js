const monBody = document.querySelector("body");

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

/*
for (let i = 7; i > 0; i--) {
    const ligneTbody = monTbody.insertRow();

    for (let j = 7; j > 0; j--) {
        ajouterUneCelluleDonnee(ligneTbody, i, j);

    }  
}*/


