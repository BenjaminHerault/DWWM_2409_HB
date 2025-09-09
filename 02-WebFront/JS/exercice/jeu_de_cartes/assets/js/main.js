// Charger les données JSON et initialiser l'affichage
fetch("./data/cardgame.json")
    .then((reponse) => reponse.json())
    .then((data) => {
        // rendre les données accessibles globalement pour d'autres scripts
        window.cardData = data;
        // Création du tableau et insertion dans la page
        creerTableauCartes(window.cardData);
        // Calcul et affichage des statistiques demandées
        afficherStatistiques(window.cardData);

        // addCard.js est chargé depuis index.html (pour éviter le double chargement)
    })
    .catch((error) => console.error(error));

function creerTableauCartes(data) {
    // Conteneur cible (créez un div avec id container dans votre HTML)
    let container = document.querySelector("#container");
    if (!container) {
        container = document.createElement("div");
        container.id = "container";
        document.body.appendChild(container);
    }

    // s'assurer qu'il existe une zone content dédiée pour le tableau/statistiques
    let content = container.querySelector("#cardContent");
    if (!content) {
        content = document.createElement("div");
        content.id = "cardContent";
        container.appendChild(content);
    }

    // Supprimer l'ancien tableau s'il existe (permet de rerender proprement)
    const oldTable = content.querySelector("#cardTable");
    if (oldTable) oldTable.remove();

    // Création du tableau
    let table = document.createElement("table");
    table.id = "cardTable";
    content.appendChild(table);

    // En-têtes
    const headers = [
        "ID",
        "Nom",
        "Niveau",
        "Puissance",
        "Attaque",
        "Armure",
        "Dommage",
        "Jouées",
        "Victoires",
        "Défaites",
        "Nuls",
    ];
    const thead = table.createTHead();
    const headRow = thead.insertRow();
    headers.forEach((h) => {
        const th = document.createElement("th");
        th.textContent = h;
        headRow.appendChild(th);
    });

    // Corps
    const tbody = table.createTBody();
    data.forEach((card) => {
        const row = tbody.insertRow();
        row.insertCell().textContent = card.id;
        row.insertCell().textContent = card.name;
        row.insertCell().textContent = card.level;
        row.insertCell().textContent = card.power;
        row.insertCell().textContent = card.attack;
        row.insertCell().textContent = card.armor;
        row.insertCell().textContent = Number(card.damage).toLocaleString();
        row.insertCell().textContent = Number(card.played).toLocaleString();
        row.insertCell().textContent = Number(card.victory).toLocaleString();
        row.insertCell().textContent = Number(card.defeat).toLocaleString();
        row.insertCell().textContent = Number(card.draw).toLocaleString();
    });

    // Si le style a déjà été injecté, éviter de le ré-ajouter
    if (!document.getElementById("cardTable-styles")) {
        const style = document.createElement("style");
        style.id = "cardTable-styles";
        style.textContent = `
        #container { display:flex; gap:16px; align-items:flex-start; }
        #cardSidebar { width: 320px; }
        #cardContent { flex:1; }
        #cardTable { border-collapse: collapse; width: 100%; max-width: 900px; margin: 12px 0; }
        #cardTable th, #cardTable td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        #cardTable th { background: #333; color: #fff; }
        #cardTable tr:nth-child(even) { background: #f9f9f9; }
        #cardTable td { font-size: 14px; }
        .statBlock { margin-top: 16px; font-family: Arial, sans-serif; }
        #addCardForm { margin: 8px 0 16px; display:flex; flex-wrap:wrap; gap:8px; }
        #addCardForm input, #addCardForm button { padding:6px 8px; font-size:13px; }
    `;
        document.head.appendChild(style);
    }
}

function afficherStatistiques(data) {
    // Conteneur cible
    let container = document.querySelector("#container");
    if (!container) {
        container = document.createElement("div");
        container.id = "container";
        document.body.appendChild(container);
    }

    // Supprimer l'ancien bloc de statistiques s'il existe
    const prevStat = container.querySelector(".statBlock");
    if (prevStat) prevStat.remove();

    const statDiv = document.createElement("div");
    statDiv.className = "statBlock";

    // 1) Carte avec le plus de parties jouées
    let plusJouee = data.reduce(
        (max, cur) => (cur.played > max.played ? cur : max),
        data[0]
    );
    const p1 = document.createElement("p");
    p1.innerHTML = `<strong>${
        plusJouee.name
    }</strong> — ${plusJouee.victory.toLocaleString()} victoires (jouées: ${plusJouee.played.toLocaleString()})`;
    statDiv.appendChild(p1);

    // 2) Carte avec le meilleur ratio victoires/défaites (ignorer les matchs nuls)
    // ratio = victory / defeat ; ignorer si defeat === 0
    let meilleur = null;
    let meilleurRatio = -Infinity;
    data.forEach((card) => {
        if (card.defeat && card.defeat > 0) {
            const ratio = card.victory / card.defeat;
            if (ratio > meilleurRatio) {
                meilleurRatio = ratio;
                meilleur = card;
            }
        }
    });

    if (meilleur) {
        const p2 = document.createElement("p");
        p2.innerHTML = `<strong>${
            meilleur.name
        }</strong> — parties: ${meilleur.played.toLocaleString()}, victoires: ${meilleur.victory.toLocaleString()}, ratio vic/déf: ${meilleurRatio.toFixed(
            2
        )}`;
        statDiv.appendChild(p2);
    } else {
        const p2 = document.createElement("p");
        p2.textContent =
            "Aucune carte avec des défaites > 0 pour calculer un ratio.";
        statDiv.appendChild(p2);
    }

    // placer le bloc de stats dans la zone content (si présente)
    const content = container.querySelector("#cardContent") || container;
    content.appendChild(statDiv);
}

// Exposer explicitement les fonctions au cas où les scripts sont chargés différemment
window.creerTableauCartes = creerTableauCartes;
window.afficherStatistiques = afficherStatistiques;
