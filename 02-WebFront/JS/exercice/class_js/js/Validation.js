/**
 * Contrôle de données
 */
export class Validation {
    validerFormatNombre(_nombre) {
        let regex = /^[\-]?[0-9]+[\.|,]?[0-9]{0,15}$/; // REGEX nombre entier ou décimal strictement positif

        if (!regex.test(_nombre)) {
            throw new Error("Ce n'est pas un nombre valide");
        }
    }

    /**
     * Valide un prix
     *  - doit etre un numérique strictement positif
     * @param {Number} _prix le prix à valider
     */
    validerNombrePositif(_nombre) {
        // try {
        this.validerFormatNombre(_nombre);

        _nombre = parseFloat(_nombre); // "12.9" --> 12.9

        if (_nombre < 0) {
            // si ce n'est pas un nombre positif !
            throw new Error("Ce n'est pas un nombre positif");
        }
        /* } catch(error) {
            throw error;
        }*/
    }

    validerNombreNegatif(_nombre) {
        this.validerFormatNombre(_nombre);

        _nombre = parseFloat(_nombre); // "12.9" --> 12.9

        if (_nombre > 0) {
            // si ce n'est pas un nombre négatif !
            throw new Error("Ce n'est pas un nombre positif");
        }
    }

    /**
     *
     */
    static validerNomArticle() {}
}
