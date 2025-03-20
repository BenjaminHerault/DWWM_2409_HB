export class Tableau
{
    // emplacementAChoisire = a deffinir avec le js et le html
     constructor() {
        // creation du tableau
         this.monTableau = document.createElement("table");
         this.monTableau.id = "monTableau";
         this.emplacementAChoisire.appendChild(this.monTableau);

        // creation du thead
        this.monThead = this.monTableau.createTHead();

        // creation de Tr
        this.ligne = this.monThead.insertRow();

        // creation du th
        // a, b, c, d, e, ... = a deffinir avec se qu'on veux mettre en entete du tableau
        this.texteTh = ["a", "b", "c", "d", "e", "..."];
        for (let i = 0; i < this.texteTh.length; i++) {
            this.monTh = document.createElement("th");
            this.monTh.textContent = this.texteTh[i];
            this.ligne.appendChild(this.monTh);
        };

        // creation du tbody
        this.monTbody = this.monTableau.createTBody();

        // inseration des données (tr) avec ligne
        // creaction d'une fonction rajouter pour les td avec donner
        this.ajouterUneCelluleDonnee = function(ligne, texte){
            this.celluleInfo = this.ligne.insertCell();
            this.celluleInfo.textContent = texte;
            return this.celluleInfo;
        };
        // rajouter des donner dans le tableau
        for(let i=0; i<data.length;i++){
            this.ligne = this.monTbody.insertRow();
            this.ajouterUneCelluleDonnee(this.ligne, data[i].a); 
            this.ajouterUneCelluleDonnee(this.ligne, data[i].b); 
            this.ajouterUneCelluleDonnee(this.ligne, data[i].c);
            this.ajouterUneCelluleDonnee(this.ligne, data[i].d); 
            this.ajouterUneCelluleDonnee(this.ligne, data[i].e);
            this.ajouterUneCelluleDonnee(this.ligne, "...");
        }
     }
}
