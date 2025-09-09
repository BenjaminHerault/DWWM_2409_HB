// Script séparé pour ajouter une carte sans mélanger la logique principale
// Ce fichier suppose que `window.cardData`, `creerTableauCartes` et `afficherStatistiques`
// sont disponibles (définis dans `main.js`).

(function () {
    // attendre que le DOM et les fonctions principales soient prêtes
    function init() {
        // placer le formulaire dans une sidebar dédiée
        const container = document.querySelector("#container") || document.body;
        let sidebar = document.querySelector("#cardSidebar");
        if (!sidebar) {
            sidebar = document.createElement("div");
            sidebar.id = "cardSidebar";
            // ajouter la sidebar APRÈS le contenu pour l'afficher à droite
            container.appendChild(sidebar);
        }

        // Ne pas dupliquer le formulaire
        if (sidebar.querySelector("#addCardForm")) return;

        const form = document.createElement("form");
        form.id = "addCardForm";

        // titre au-dessus du formulaire
        const h = document.createElement("h3");
        h.textContent = "Ajouter une carte";
        h.style.margin = "0 0 8px 0";
        sidebar.appendChild(h);

        // Champs simples: name + plusieurs nombres
        const fields = [
            { name: "name", placeholder: "Nom", type: "text" },
            { name: "level", placeholder: "Niveau", type: "number" },
            { name: "power", placeholder: "Puissance", type: "number" },
            { name: "attack", placeholder: "Attaque", type: "number" },
            { name: "armor", placeholder: "Armure", type: "number" },
            { name: "damage", placeholder: "Dommage", type: "number" },
            { name: "played", placeholder: "Jouées", type: "number" },
            { name: "victory", placeholder: "Victoires", type: "number" },
            { name: "defeat", placeholder: "Défaites", type: "number" },
            { name: "draw", placeholder: "Nuls", type: "number" },
        ];

        // descriptions visibles pour aider l'utilisateur
        const descriptions = {
            name: "Nom affiché de la carte (ex: Dragon)",
            level: "Niveau ou rang de la carte",
            power: "Puissance générale",
            attack: "Valeur d'attaque",
            armor: "Valeur d'armure/défense",
            damage: "Dégâts moyens ou total",
            played: "Nombre de parties jouées avec la carte",
            victory: "Nombre de victoires",
            defeat: "Nombre de défaites (utilisé pour le ratio)",
            draw: "Nombre de matchs nuls",
        };

        fields.forEach((f) => {
            // wrapper label pour rendre le formulaire lisible
            const wrapper = document.createElement("label");
            wrapper.style.display = "flex";
            wrapper.style.flexDirection = "column";
            wrapper.style.fontSize = "13px";
            wrapper.style.marginRight = "8px";

            const caption = document.createElement("span");
            caption.textContent = f.placeholder;
            caption.style.fontWeight = "600";
            caption.style.marginBottom = "4px";
            wrapper.appendChild(caption);

            const input = document.createElement("input");
            input.name = f.name;
            input.placeholder = f.placeholder;
            input.type = f.type;
            if (f.type === "number") input.value = "0";
            // tooltip natif
            input.title = descriptions[f.name] || "";
            input.style.padding = "6px";
            input.style.fontSize = "13px";
            wrapper.appendChild(input);

            const help = document.createElement("small");
            help.textContent = descriptions[f.name] || "";
            help.style.color = "#555";
            help.style.fontSize = "11px";
            help.style.marginTop = "4px";
            wrapper.appendChild(help);

            form.appendChild(wrapper);
        });

        const submit = document.createElement("button");
        submit.type = "submit";
        submit.textContent = "Ajouter la carte";
        form.appendChild(submit);

        // Positionner le formulaire dans la sidebar
        sidebar.appendChild(form);

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            // Récupérer les données
            const formData = new FormData(form);
            const name = formData.get("name") || "Carte sans nom";

            // Calculer nouvel id
            let nextId = 1;
            if (Array.isArray(window.cardData) && window.cardData.length) {
                nextId =
                    Math.max(...window.cardData.map((c) => Number(c.id) || 0)) +
                    1;
            }

            const newCard = {
                id: nextId,
                name: String(name),
                level: Number(formData.get("level")) || 0,
                power: Number(formData.get("power")) || 0,
                attack: Number(formData.get("attack")) || 0,
                armor: Number(formData.get("armor")) || 0,
                damage: Number(formData.get("damage")) || 0,
                played: Number(formData.get("played")) || 0,
                victory: Number(formData.get("victory")) || 0,
                defeat: Number(formData.get("defeat")) || 0,
                draw: Number(formData.get("draw")) || 0,
            };

            // Ajouter aux données et rerender
            if (!Array.isArray(window.cardData)) window.cardData = [];
            window.cardData.push(newCard);

            // appeler les fonctions globales définies dans main.js
            if (typeof window.creerTableauCartes === "function") {
                window.creerTableauCartes(window.cardData);
            }
            if (typeof window.afficherStatistiques === "function") {
                window.afficherStatistiques(window.cardData);
            }

            // Réinitialiser le formulaire
            form.reset();
            // Remettre des 0 pour les champs numériques
            form.querySelectorAll('input[type="number"]').forEach(
                (i) => (i.value = "0")
            );
        });
    }

    // Si le DOM est prêt, init; sinon attendre
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
