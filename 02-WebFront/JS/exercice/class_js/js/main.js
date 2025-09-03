import { Article } from "./Article.js";

const formulaire = document.getElementById("formulaire");
const nom = document.getElementById("nom");
const prix = document.getElementById("prix");
const tva = document.getElementById("tva");
const articles = document.getElementById("articles"); // conteneur des articles ajoutés

/**
 * Lorsque le formulaire est soumis :
 * 1. Récupère les données du formulaire
 * 2. Crée une instance d'une classe repésentant 1 article
 * 3. Valide les données de l'objet
 * 4. Appelle la fonction qui ajoute l'article validé dans la page HTML
 * 5.(Bonus) Sauvegarde les articles dans le stockage local du navigateur
 */
formulaire.addEventListener("submit", (event) => {
    event.preventDefault();

    let monNom = nom.value;
    let monPrix = prix.value;
    let maTva = tva.value;

    let monArticle = new Article(monNom, monPrix, maTva);
    // let monArticle = new Article(nom.value, prix.value, tva.value);

    try {
        monArticle.estValide();
        console.log(monArticle);
        ajouterArticle(monArticle);
    } catch (error) {
        console.log("ERREUR: " + error);
    }
});

/**
 * Ajoute un article validé dans la page HTML sous le formulaire
 * @param {Article} _article l'article à ajouter
 */
function ajouterArticle(_article) {
    let li = document.createElement("li");

    // Le traitement se fera ici*
    li.textContent = _article.nom + " " + _article.prixTTC();

    articles.appendChild(li);
}
