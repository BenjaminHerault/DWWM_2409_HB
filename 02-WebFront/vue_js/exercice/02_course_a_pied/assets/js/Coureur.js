export class Coureur {
    constructor(_nom, _pays, _temps) {
        this.nom = _nom;
        this.pays = _pays;
        this.temps = _temps;

        // on split le nom en deux parti : prenom et nom
        const [leNom, prenom] = this.nom.split(" ");
        this.prenom = prenom;
        this.leNom = leNom;
        this.nom = `${this.prenom} ${this.leNom}`;

        this.tempsConverti = this.convertirTemps(this.temps);
    }
    convertirTemps(secondes) {
        const minutes = Math.floor(secondes / 60); // Divise les secondes par 60 pour obtenir les minutes
        const resteSecondes = secondes % 60; // Utilise le reste de la division pour obtenir les secondes restantes
        const secondesFormatees = resteSecondes.toString().padStart(2, "0");
        return `${minutes}min${secondesFormatees}`; // Retourne une chaîne formatée
    }
}

/*
toString() : Convertit le nombre en chaîne de caractères.
padStart(2, '0') : Ajoute un zéro au début de la chaîne si elle contient moins de 2 caractères.
*/
