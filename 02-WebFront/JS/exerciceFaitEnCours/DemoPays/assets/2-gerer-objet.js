// Utiliser un objet littéral existant
const laFrance = {
    "country_code": "FR",
    "country_name": "France"
}

// ou charger un objet depuis un fichier JSON
const response = await fetch('./data/belgique.json');
const laBelgique = await r.json();


console.log(laFrance);
console.log(laBelgique);

