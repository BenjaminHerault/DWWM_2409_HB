const monTexteFr = document.getElementById("principal");
const monArticleFr = document.createElement("article");
const lesInfosFr = document.createElement("p");

const monArticleBe = document.createElement("article");
const lesInfosBe = document.createElement("p");

// Utiliser un objet littéral existant
const laFrance = {
    "country_code": "FR",
    "country_name": "France"
}
monTexteFr.appendChild(monArticleFr);
monArticleFr.appendChild(lesInfosFr);

lesInfosFr.innerHTML = "Pays 1 : " + laFrance.country_name + " (" + laFrance.country_code + ")";

const laBelgique = {
    "country_code": "BE",
    "country_name": "Belgique"
};
monTexteFr.appendChild(monArticleBe);
monArticleBe.appendChild(lesInfosBe);

lesInfosBe.innerHTML = "Pays 2 : " + laBelgique.country_name + " (" + laBelgique.country_code + ")";

