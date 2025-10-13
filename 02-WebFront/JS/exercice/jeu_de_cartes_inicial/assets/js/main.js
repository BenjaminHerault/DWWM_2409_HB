// Charger les données JSON (même logique que l'exemple)
fetch("./data/cardgame.json")
    .then((reponse) => reponse.json())
    .then((data) => {
        // Création du tableau et insertion dans la page
        creerTableauCartes(data);
        // Calcul et affichage des statistiques demandées
        afficherStatistiques(data);
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

    // Création du tableau
    let table = document.createElement("table");
    table.id = "cardTable";
    container.appendChild(table);

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
        row.insertCell().textContent = card.damage.toLocaleString();
        row.insertCell().textContent = card.played.toLocaleString();
        row.insertCell().textContent = card.victory.toLocaleString();
        row.insertCell().textContent = card.defeat.toLocaleString();
        row.insertCell().textContent = card.draw.toLocaleString();
        // toLocaleString() est une méthode disponible sur les objets Number et Date en JavaScript.
        // Elle renvoie une chaîne formatée selon la locale courante (ou la locale passée en premier argument),
        // utile pour afficher des nombres avec séparateurs de milliers et format décimal localisé.
    });

    // Ajout d'un style minimal afin de ressembler à la capture
    const style = document.createElement("style");
    style.textContent = `
        #cardTable { border-collapse: collapse; width: 100%; max-width: 900px; margin: 12px 0; }
        #cardTable th, #cardTable td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        #cardTable th { background: #333; color: #fff; }
        #cardTable tr:nth-child(even) { background: #f9f9f9; }
        #cardTable td { font-size: 14px; }
        .statBlock { margin-top: 16px; font-family: Arial, sans-serif; }
    `;
    document.head.appendChild(style);
}

function afficherStatistiques(data) {
    // Conteneur cible
    let container = document.querySelector("#container");
    if (!container) {
        container = document.createElement("div");
        container.id = "container";
        document.body.appendChild(container);
    }

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

    container.appendChild(statDiv);
}
