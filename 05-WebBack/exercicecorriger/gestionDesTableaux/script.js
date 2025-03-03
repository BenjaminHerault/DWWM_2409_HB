const people = ['Mike Dev', 'John Makenzie', 'Léa Grande'];

const liste = document.querySelector("#inscrit");

liste.setAttribute("style", "list-style:none; color:#ACCBE1");

document.body.style.backgroundColor="#536B78";
document.body.style.color="#ACCBE1";
document.querySelector("h1").setAttribute("style", "margin-left:50px; font-family:tahoma;text-transform:uppercase");

document.querySelector("#filet").setAttribute("style", "border:2px dashed #ACCBE1");

for (let i = 0; i < people.length; i++) {
   
    let monItem= document.createElement("li");
    monItem.setAttribute("style", "font-family:tahoma; font-size:1.6rem");
    monItem.textContent=people[i];
    liste.appendChild(monItem);
    
}
const tab = document.querySelector("#donnee");

function ajouterUneCelluleTitre (ligne, texte){
    let cellule = document.createElement("th");
    cellule.style.border="1px solid #ACCBE1";
    cellule.style.padding = "10px";
    cellule.textContent = texte;
    ligne.appendChild(cellule);
};
function ajouterUneCelluleDonnee (ligne, texte){
    let cellule = ligne.insertCell();
    cellule.textContent = texte;
    // return cellule;
};
let header = tab.createTHead();
let ligne = header.insertRow();

tab.setAttribute("cellspacing", "0");
tab.setAttribute("style", "border:2px solid #ACCBE1; background-color:#647182");


let tabTitre = ["Nom", "Prénom", "Email"];
for (let i = 0; i < tabTitre.length; i++) {
    ajouterUneCelluleTitre(ligne,tabTitre[i]);
}
// let mail = tabtitre[0]+"."+tabTitre[1]+"@example.com";
//         ajouterUneCelluleTitre(ligne, mail);