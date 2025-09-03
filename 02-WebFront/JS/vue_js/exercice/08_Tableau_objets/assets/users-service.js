/*
  Fichier : assets/users-service.js
  Rôle : service simple pour charger et manipuler des données utilisateur
  - charge un JSON d'utilisateurs
  - fournit des utilitaires : normalisation, construction d'identifiant,
    authentification basique, génération d'email, formatage de date/salaire

  Remarque : pour préserver la compatibilité avec le code existant, les
  méthodes originales (en anglais) sont conservées et des alias en français
  sont ajoutés plus bas dans la classe.
*/

export class UsersService {
    // Le constructeur prend l'URL du fichier JSON (par défaut ./data/info.json)
    constructor(dataUrl = "./data/info.json") {
        this.dataUrl = dataUrl; // URL pour fetch
        this.users = []; // cache local des utilisateurs
    }

    // Charge les utilisateurs depuis le fichier JSON et les stocke dans this.users
    async loadUsers() {
        try {
            const resp = await fetch(this.dataUrl); // requête HTTP GET
            this.users = await resp.json(); // parsage JSON
        } catch (err) {
            // En cas d'erreur, log pour debugging et retour d'un tableau vide
            console.error("Erreur chargement users", err);
            this.users = [];
        }
        return this.users; // renvoie le tableau (utile pour await dans le code appelant)
    }

    // Normalise une chaîne pour la recherche / comparaison
    // - supprime accents, diacritiques
    // - met en minuscules et trim
    normalizeString(s) {
        if (!s) return "";
        // table de correspondance pour certains caractères accentués
        const from = "ÀÁÂÃÄÅàáâãäåÇçÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖØòóôõöøÙÚÛÜùúûüÝýÿÑñ";
        const to = "AAAAAAaaaaaaCcEEEEeeeeIIIIiiiiOOOOOOooooooUUUUuuuuYyyNn";
        // remplacement caractère par caractère selon la table ci-dessus
        let res = s
            .split("")
            .map((c) => {
                const idx = from.indexOf(c);
                return idx > -1 ? to[idx] : c;
            })
            .join("");
        // utilisation de normalize + suppression des diacritiques Unicode, puis
        // mise en minuscules et trim des espaces en bordure
        return res
            .normalize("NFKD")
            .replace(/\p{Diacritic}/gu, "")
            .toLowerCase()
            .trim();
    }

    // Construit l'identifiant d'un utilisateur à partir de firstname.lastname
    buildIdentifier(user) {
        const first = this.normalizeString(user.firstname || "");
        const last = this.normalizeString(user.lastname || "");
        return `${first}.${last}`;
    }

    // Authentifie un utilisateur : cherche dans this.users un identifiant égal
    // à celui construit (buildIdentifier) et vérifie le mot de passe.
    authenticate(ident, mdp) {
        const norm = ident ? ident.toLowerCase().trim() : "";
        for (const u of this.users) {
            const id = this.buildIdentifier(u);
            if (id === norm && String(u.password) === String(mdp)) return u;
        }
        return null; // null si pas trouvé
    }

    // Génère un email basique firstname.lastname@example.com
    generateEmail(user) {
        const domain = "example.com";
        const first = (user.firstname || "")
            .toLowerCase()
            .trim()
            .replace(/\s+/g, ".");
        const last = (user.lastname || "")
            .toLowerCase()
            .trim()
            .replace(/\s+/g, ".");
        return `${first}.${last}@${domain}`;
    }

    // Formatage minimal de date (ici on renvoie la chaîne telle quelle)
    formatDate(iso) {
        return iso || "";
    }

    // Formatage d'un nombre en devise EUR (locale fr-FR)
    formatSalary(n) {
        return new Intl.NumberFormat("fr-FR", {
            style: "currency",
            currency: "EUR",
        }).format(n);
    }

    // -------------------- alias en français --------------------
    // Les méthodes suivantes appellent les méthodes existantes mais portent
    // des noms en français pour être plus lisibles dans ton code.

    // alias de normalizeString
    normaliserChaine(s) {
        return this.normalizeString(s);
    }

    // alias de buildIdentifier
    construireIdentifiant(user) {
        return this.buildIdentifier(user);
    }

    // alias de authenticate
    authentifier(ident, mdp) {
        return this.authenticate(ident, mdp);
    }

    // alias de generateEmail
    genererEmail(user) {
        return this.generateEmail(user);
    }

    // alias de formatDate
    formatDateFR(iso) {
        return this.formatDate(iso);
    }

    // alias de formatSalary
    formatSalaire(n) {
        return this.formatSalary(n);
    }
}
