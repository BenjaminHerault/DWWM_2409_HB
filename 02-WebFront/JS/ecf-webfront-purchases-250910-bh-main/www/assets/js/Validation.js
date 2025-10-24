export class Validation {
    /**
     * Vérifie que le nom et le prénom contiennent au moins 3 caractères
     * @param {string} nom
     * @param {string} prenom
     * @returns {boolean}
     */
    static nomPrenomValides(_nom, _prenom) {
        // Regex : au moins 3 lettres, accepte espaces, pas de chiffres ni caractères spéciaux
        const regex = /^[A-Za-zÀ-ÿ\s]{3,}$/;
        if (!regex.test(_nom)) {
            throw new Error(
                "Le nom doit contenir au moins 3 lettres et uniquement des lettres ou espaces"
            );
        }
        if (!regex.test(_prenom)) {
            throw new Error(
                "Le prénom doit contenir au moins 3 lettres et uniquement des lettres ou espaces"
            );
        }
        return true;
    }

    /**
     * Vérifie que la date de livraison est au bon format et au moins 8 jours dans le futur
     * @param {string} dateVerif
     * @throws {Error} si la date n'est pas valide ou pas assez éloignée
     */
    static dateLivraisonValide(dateVerif) {
        const regex = /^[\-]?[0-9]+[\.|,]?[0-9]{0,15}$/;
        if (!regex.test(dateVerif.replaceAll("-", ""))) {
            throw new Error("Format de date invalide");
        }
        // Vérification que la date est au moins 8 jours dans le futur
        const dateFutur = new Date(dateVerif);
        const dateAujourdhui = new Date();
        // On met à 00:00:00 pour éviter les problèmes d'heure
        dateFutur.setHours(0, 0, 0, 0);
        dateAujourdhui.setHours(0, 0, 0, 0);
        const diffJours = (dateFutur - dateAujourdhui) / (1000 * 60 * 60 * 24);
        if (diffJours < 8) {
            throw new Error(
                "La date de livraison doit être au moins 8 jours dans le futur"
            );
        }
        return true;
    }
}
