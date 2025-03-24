const monBody = document.querySelector("body");
const monTbody = document.querySelector("tbody");
let monJoueur = "Rouge";

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
    console.log(monTableau);
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
    celluleInfo.textContent = idLigne;

    celluleInfo.addEventListener( "click", function(event){
        positionnement(event);
    });

    if(monTableau[cord_X][cord_Y] === false) {
        celluleInfo.classList.add("unJetonRouge");
    } else if(monTableau[cord_X][cord_Y] === true) {
        celluleInfo.classList.add("unJetonJaune");
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
            if(monJoueur === "Rouge") {
                monTableau[k][y] = false;
                verifierGagnant();
                monJoueur = "Jaune";
            } else {
                monTableau[k][y] = true;
                verifierGagnant();
                monJoueur = "Rouge";
            }
            //monJoueur = monJoueur === "Rouge" ? "Jaune" : "Rouge";
            genererTableauHtml();
            return;
        }
    }
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
        let compteur_gagant = 0;
        for(let n = 0; n < monTableau[b].length; n++){
            if(monTableau[b][n]  === (monJoueur === "Rouge" ? false : true)){
                compteur_gagant++;
                if(compteur_gagant === 4){
                    window.alert("Nous avont un gagant bravo a "+ monJoueur)
                    location.reload()
                };
            } 
            else{
                compteur_gagant = 0;
            }; 
        };
    };
    /*
    * vertical
    */
    for (let c = 0; c < monTableau[0].length; c++){
        let compteur_gagant = 0;
        for(let p = 0 ; p < monTableau.length; p++){
            if(monTableau[p][c]  === (monJoueur === "Rouge" ? false : true)){
                compteur_gagant++;
                if(compteur_gagant === 4){
                    window.alert("Nous avont un gagant bravo a "+ monJoueur)
                    location.reload()
                };
            } 
            else{
                compteur_gagant = 0;
            }; 
        };
    }
    /*
     * diagonal  
     */
    for(let b = 6 ; b >=0; b--){
        let compteur_gagant = 0;
        for(let n = 0; n < monTableau[b].length; n++){
            if(monTableau[b][n]  === (monJoueur === "Rouge" ? false : true)){
                compteur_gagant++;
                
                if(compteur_gagant === 4){
                    window.alert("Nous avont un gagant bravo a "+ monJoueur)
                    location.reload()
                };
            } 
            else{
                compteur_gagant = 0;
            }; 
        };
    };
}; 