const people = ['Mike Dev', 'John Makenzie', 'Léa Grande'];
const liste = document.querySelector("#inscrit");
const tab = document.querySelector("#donnee");

liste.setAttribute("style","color:#ACCBE1");
document.body.style.backgroundColor="#536B78";
document.body.style.color="#ACCBE1";
document.querySelector("h1").setAttribute("style", "margin-left:50px; font-family:tahoma;text-transform:uppercase");
document.querySelector("#filet").setAttribute("style", "border:2px solid #ACCBE1");
tab.setAttribute("cellspacing", "0");
tab.setAttribute("style", "border:2px solid #ACCBE1; background-color:#647182");

function ajouterUneCelluleTitre (ligne, texte){
    let cellule = document.createElement("th");
    cellule.style.border="1px solid #ACCBE1";
    cellule.style.padding = "10px";
    cellule.textContent = texte;
    ligne.appendChild(cellule);
};
function ajouterUneCelluleDonnee (ligne, texte){
    let cellule1 = ligne.insertCell();
    cellule1.textContent = texte;
    cellule1.style.border="1px solid #ACCBE1";
    cellule1.style.padding = "8px";
    cellule1.textContent = texte;
    ligne.appendChild(cellule1);
    return cellule1;
};

for (let i = 0; i < people.length; i++) {
    let monItem= document.createElement("li");
    monItem.setAttribute("style", "font-family:tahoma; font-size:1.6rem;");
    monItem.textContent=people[i];
    liste.appendChild(monItem);
}

let header = tab.createTHead();
let ligne = header.insertRow();

let tabTitre = ["Nom", "Prénom", "Email","Supprimer"];
for (let i = 0; i < tabTitre.length; i++) {
    ajouterUneCelluleTitre(ligne,tabTitre[i]);
}
for (let y = 0; y < people.length; y++) {
    ligne = tab.insertRow();
    let nomEtPrenom = people[y].split(" ");
    ajouterUneCelluleDonnee(ligne, nomEtPrenom[0]);
    ajouterUneCelluleDonnee(ligne, nomEtPrenom[1]);
    nomEtPrenom.push(people[y].split(" "));        
    let email = nomEtPrenom[0].toLowerCase() + "." + nomEtPrenom[1].toLowerCase() + "@example.com";
    let supp = "X";
    ajouterUneCelluleDonnee(ligne, email);
    let suppStyle = ajouterUneCelluleDonnee(ligne, supp);
    suppStyle.setAttribute("style","text-align:center;cursor:crosshair;font-weight: bold;border:1px solid #ACCBE1;");
    
    }

let newCell = HTMLTableRowElement.insertCell(tabTitre);
