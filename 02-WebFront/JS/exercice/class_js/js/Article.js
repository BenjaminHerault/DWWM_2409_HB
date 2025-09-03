import { Validation } from "./Validation.js";

/**
 * Représente un article
 * @author Benji <benji@example.com>
 * @version 1.0
 */
export class Article {
    /**
     * constructeur
     * @param {String} _nom Le nom de l'article
     * @param {Number} _prixHT Le prix Hors taxes de l'article
     * @param {Number} _tva  La TVA appliquée à l'article
     */
    constructor(_nom, _prixHT, _tva) {
        this.nom = _nom;
        this.prixHT = _prixHT;
        this.tva = _tva;
    }

    estValide() {
        let validation = new Validation();
        validation.validerNombrePositif(this.prixHT);
    }

    /**
     * Calcule et retourne le prix TTC de l'article
     * @returns {Number} Le prix TTC
     */
    prixTTC() {
        return this.prixHT * (1 + this.tva / 100);
    }
}
