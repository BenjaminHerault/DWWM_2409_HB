const monBody = document.querySelector("body");
const monTbody = document.querySelector("tbody");
let monJoueur = "Soleil";

/**
 * @var monTableau le tableau contenant les jetons
 * pour une case : 
 *  - null = case vide
 *  - false = case rouge
 *  - true = case jaune
 */
const monTableau = [];

/** 
 * @var ligne 
 * mon tableau de valeur PAS vissible pour l'utilisateur 
*/
for (let i = 0; i < 7; i++) {
    let ligne = [];
    for (let j = 0; j < 7; j++) {
        ligne.push(null);
    }
    monTableau.push(ligne);
}
/**
 * @var genererTableauHtml Le tableau html vissible par l'utilisateur 
 */
genererTableauHtml();

function genererTableauHtml() {
    console.table(monTableau);
    monTbody.innerHTML = '';
    for(let i = 0; i < monTableau.length; i++) {
        const ligneTbody = monTbody.insertRow();
        for(let j = 0; j < monTableau[i].length; j++) {
            ajouterUneCelluleDonnee(ligneTbody, i, j);
        }
    }
}
/**
 * 
 * @param {*} ligne 
 * @param {*} cord_X une ligne (x)
 * @param {*} cord_Y une colonne (y)
 * @returns 
 * 
 * @var celluleInfo cree un td avec insertCell
 * celluleInfo.addEventListener( "click",...)
 * car on selection une case du tableau
 * 
 * le if prend les la position du x et y qui le passe en false pour le jeton rouge
 * le else prend les la position du x et y qui le passe en true pour le jeton jaune
 * 
 */
// creation d'une fonction rajouter
function ajouterUneCelluleDonnee(ligne, cord_X, cord_Y){
    let celluleInfo = ligne.insertCell();
    let idLigne = cord_X +"-"+ cord_Y;
    celluleInfo.id = idLigne;
    celluleInfo.dataset.x = cord_X; 
    celluleInfo.dataset.y = cord_Y;
    // celluleInfo.textContent = idLigne;

    celluleInfo.addEventListener( "click", function(event){
        positionnement(event);
    });

    if(monTableau[cord_X][cord_Y] === false) {
        celluleInfo.classList.add("unJetonSoleil");
    } else if(monTableau[cord_X][cord_Y] === true) {
        celluleInfo.classList.add("unJetonLune");
    }

    return celluleInfo;
};

/**
 * 
 * @param {*} event on va prendre l'evenement du clique 
 * @returns 
 * 
 * 
 * on va modifier le talbeau de valeurs QUI n'ait pas Vissible pour l'utilisateur null *va prendre rouge ou jaune 
 * 
 * on va supprimer le tableau que l'utilisateur voir pour afficher le jeton de couleurs 
 * 
 */
const positionnement = (event) => {
    let x = event.target.dataset.x;
    let y = event.target.dataset.y;

    // console.log(x+" je suis la ligne (x)");
    // console.log(y+ " je suis la colonne (y)");

    for(let k = 6; k >= 0; k--) {
        if(monTableau[k][y] === null) {

            let monTd = rechercherCellule(k, y);

            if(monJoueur === "Soleil") {
                monTableau[k][y] = false;
                verifierGagnant();
                monTd.classList.add("unJetonSoleil");
                monJoueur = "Lune";
            } else {
                monTableau[k][y] = true;
                verifierGagnant();
                monTd.classList.add("unJetonLune");
                monJoueur = "Soleil";
            }
            //monJoueur = monJoueur === "Rouge" ? "Lune" : "Soleil";
            //genererTableauHtml();
            return;
        }
    }
}

function rechercherCellule(x, y) {
    let mesTd = document.getElementsByTagName("td");
    mesTd = Array.from(mesTd);
    // console.log(mesTd);

    let monTd = mesTd.find(td => td.dataset.x == x && td.dataset.y == y);
    // console.log(monTd);
    
    return monTd;
 }
/**
 * for (let i = 0; i< monTableau.length; i++) 
 * Cette boucle parcourt chaque ligne du tableau
 * 
 * for (let j = 0; j < monTableau[i].length; j++)
 * Cette boucle parcourt chaque cellule de la ligne actuelle
 */
function verifierGagnant() {
    /*
    * horizontal
    */ 
    for(let b = 6 ; b >=0; b--){
        let compteur_gagnant_horizontal = 0;
        for(let n = 0; n < monTableau[b].length; n++){
            if(monTableau[b][n]  === (monJoueur === "Soleil" ? false : true)){
                compteur_gagnant_horizontal++;
                if(compteur_gagnant_horizontal === 4){
                    un_gagnant(monJoueur);
                };
            } 
            else{
                compteur_gagnant_horizontal = 0;
            }; 
        };
    };
    /*
    * vertical
    */
    for (let c = 0; c < monTableau[0].length; c++){
        let compteur_gagnant_vertical = 0;
        for(let p = 0 ; p < monTableau.length; p++){
            if(monTableau[p][c]  === (monJoueur === "Soleil" ? false : true)){
                compteur_gagnant_vertical++;
                if(compteur_gagnant_vertical === 4){
                    un_gagnant(monJoueur);
                };
            } 
            else{
                compteur_gagnant_vertical = 0;
            }; 
        };
    }
    
    // diagonale montante 
    for(let i = 0; i < monTableau.length; i++){
        for(let j = 0; j < monTableau[i].length; j++){
            if(diagonal_montante(i,j)){
                un_gagnant(monJoueur);
            }
        };
    };
    //diagonale descendante 
    for(let t = 0; t < monTableau.length; t++){
        for(let e = 0; e < monTableau[t].length; e++){
            if (diagonal_descendante(t,e)){
                un_gagnant(monJoueur);
            };
        };
    };
}; 
/**
 * 
 * @param {*} x 
 * @param {*} y 
 * @returns 
 */
function diagonal_montante(x,y){
    let compteur_diag_montante=0;
    for(let i = 0; i < 4; i++){
        if(x + i < monTableau.length && y + i < monTableau[x].length && monTableau[x + i][y + i] ===(monJoueur === "Soleil" ? false : true)){
            compteur_diag_montante++;
        }
    };
    return compteur_diag_montante === 4;
};
/**
 * 
 * @param {*} x 
 * @param {*} y 
 * @returns 
 * 
 * x - i >= 0 le -i >=0 car sa toi rester dans le tableau
 * 
 */
function diagonal_descendante(x,y){
    let compteur_diag_descendante=0;
    for(let i = 0; i < 4; i++){
        if(x - i >= 0  && y + i < monTableau[x].length && monTableau[x - i][y + i ]===(monJoueur === "Soleil" ? false : true)){
            compteur_diag_descendante++;
        };
    };
    return compteur_diag_descendante === 4;
};

let partieTerminee = false;

function un_gagnant(monJoueur){
    if(partieTerminee === false) {
        setTimeout(() => {
            alert("Nous avons un gagnant. Bravo à "+ monJoueur);
            if(window.confirm("Souhaitez-vous jouer une nouvelle parti ?")){
                window.location.reload(); 
            } else {
                partieTerminee = true;
            }
            //nouvellePartie();
         }, 100);
    }
};
