let zipcodes = [];

// En tant que module, on utilise import.meta.url pour pointer vers le fichier JSON
const dataUrl = new URL("../../data/zipcodes.json", import.meta.url);

// Charger les données JSON et normaliser les clés (certaines sources utilisent codePostal/nomCommune)
fetch(dataUrl)
    .then((response) => {
        if (!response.ok) throw new Error("Erreur HTTP " + response.status);
        return response.json();
    })
    .then((data) => {
        zipcodes = data.map((item) => ({
            code: item.codePostal || item.code || "",
            ville: item.nomCommune || item.libelleAcheminement || "",
        }));
    })
    .catch((err) => {
        console.error("Impossible de charger les données :", err);
    });

const searchInput = document.getElementById("searchInput");
const suggestions = document.getElementById("suggestions");
const result = document.getElementById("result");
const form = document.getElementById("searchForm");

if (!searchInput || !suggestions || !result || !form) {
    console.error("Éléments du DOM manquants : vérifie les ids dans le HTML");
}

// Suggestions dynamiques (filtre sur le code postal ou le nom de la ville)
searchInput.addEventListener("input", function () {
    const value = this.value.trim();
    suggestions.innerHTML = "";
    if (value.length === 0) return;
    const vLower = value.toLowerCase();
    const filtered = zipcodes
        .filter(
            (item) =>
                (item.code && item.code.includes(value)) ||
                (item.ville && item.ville.toLowerCase().includes(vLower))
        )
        .slice(0, 12); // limiter le nombre de suggestions

    filtered.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.code + " - " + item.ville;
        suggestions.appendChild(option);
    });
});

// Affichage des infos à la validation
form.addEventListener("submit", function (e) {
    e.preventDefault();
    const value = searchInput.value.trim();
    if (!value) {
        result.textContent = "Veuillez saisir un code postal ou une ville.";
        return;
    }

    let found = zipcodes.find(
        (item) =>
            `${item.code} - ${item.ville}` === value ||
            item.code === value ||
            item.ville.toLowerCase() === value.toLowerCase()
    );

    if (!found) {
        // recherche partielle
        const vLower = value.toLowerCase();
        found = zipcodes.find(
            (item) =>
                (item.code && item.code.includes(value)) ||
                (item.ville && item.ville.toLowerCase().includes(vLower))
        );
    }

    if (found) {
        result.innerHTML = `<strong>Ville :</strong> ${found.ville}<br><strong>Code postal :</strong> ${found.code}`;
    } else {
        result.textContent = "Aucune ville trouvée.";
    }
});
