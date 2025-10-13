// Définition de l'objet d'options Vue
const monApp = {
    // état local de l'application
    data() {
        return {
            // liste des cartes chargée depuis cardgame.json
            listeCarte: [],
        };
    },

    /*
      Hook created : appelé automatiquement quand l'instance Vue est créée.
      Ici on charge le fichier JSON contenant les cartes.
      - fetch : récupère le fichier ./data/cardgame.json
      - response.ok : vérifie le code HTTP (200..299)
      - response.json() : parse le corps en JSON (objet JS)
      - map(...) : on parcourt chaque élément du tableau JSON pour normaliser
        certains champs (conversion en Number) et construire `listeCarte`.
    */
    async created() {
        // charge le JSON local
        try {
            // récupération du fichier JSON (requête HTTP GET)
            const response = await fetch("./data/cardgame.json");
            // si la réponse n'est pas OK (404, 500...), on lance une erreur
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            // parse du JSON en objet JavaScript
            const json = await response.json();
            // on s'assure que les nombres existent et sont bien typés
            // on copie chaque objet (spread) puis on force les champs numériques
            this.listeCarte = json.map((c) => ({
                ...c, // copie toutes les propriétés existantes de la carte
                // conversion en Number ; si échec, on garde 0
                played: Number(c.played) || 0,
                victory: Number(c.victory) || 0,
                defeat: Number(c.defeat) || 0,
                draw: Number(c.draw) || 0,
                damage: Number(c.damage) || 0,
            }));
        } catch (err) {
            // en cas d'erreur (fichier manquant, JSON invalide...), on log et on vide la liste
            console.error("Impossible de charger cardgame.json :", err);
            this.listeCarte = [];
        }
    },

    computed: {
        // carte avec le plus grand nombre de parties jouées
        plusJouee() {
            if (!this.listeCarte.length) return null;
            return this.listeCarte.reduce(
                (best, c) => (c.played > (best?.played ?? -1) ? c : best),
                null
            );
        },

        // carte avec le meilleur ratio victory/defeat (ignorer defeat === 0)
        meilleurRatio() {
            const candidats = this.listeCarte.filter(
                (c) => Number(c.defeat) > 0
            );
            if (!candidats.length) return null;
            let best = null;
            for (const c of candidats) {
                const ratio = Number(c.victory) / Number(c.defeat);
                if (!best || ratio > best.ratio) {
                    best = { ...c, ratio };
                }
            }
            return best;
        },
    },

    methods: {
        // formate un nombre avec des espaces pour les milliers (ex: 500062 -> "500 062")
        formatNumber(n) {
            return n?.toString()?.replace(/\B(?=(\d{3})+(?!\d))/g, " ") || "0";
        },
    },
};
// création et montage de l'app Vue
Vue.createApp(monApp).mount("#app");
