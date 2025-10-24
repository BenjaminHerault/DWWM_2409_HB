import { Validation } from "./Validation.js";

// Affichage du montant total de la commande
const quantiteInput = document.getElementById("quantite");
const prixInput = document.getElementById("prix");
const totalCommande = document.getElementById("total-commande");

function leTotale() {
    const quantite = parseInt(quantiteInput.value, 10) || 0;
    const prix = Math.ceil(parseFloat(prixInput.value)) || 0;
    const total = quantite * prix;
    if (quantite > 0 && prix > 0) {
        totalCommande.textContent = `Montant total de la commande : ${total} €`;
    } else {
        totalCommande.textContent = "";
    }
}

quantiteInput.addEventListener("input", leTotale);
prixInput.addEventListener("input", leTotale);
document.addEventListener("DOMContentLoaded", leTotale);

const formulaire = document.getElementById("purchase");
const resetButton = document.querySelector('button[type="reset"]');

formulaire.addEventListener("submit", function (event) {
    event.preventDefault();

    // Suppression de l'ancien message d'erreur ou de confirmation
    let messageDiv = document.getElementById("form-message");
    if (messageDiv) messageDiv.remove();

    try {
        // Récupération des valeurs nécessaires
        const nom = document.getElementById("nom").value.trim();
        const prenom = document.getElementById("prenom").value.trim();
        const dateLivraison = document.getElementById("date-livraison").value;
        const quantite = parseInt(quantiteInput.value, 10) || 0;
        const prix = Math.ceil(parseFloat(prixInput.value)) || 0;
        const total = quantite * prix;

        // Validation nom/prénom
        Validation.nomPrenomValides(nom, prenom);
        // Validation date de livraison
        Validation.dateLivraisonValide(dateLivraison);

        // Création du message de confirmation
        messageDiv = document.createElement("div");
        messageDiv.id = "form-message";
        messageDiv.style.margin = "1em 0";
        messageDiv.style.fontWeight = "bold";
        if (total > 1000) {
            messageDiv.textContent = `${nom} ${prenom}, Votre demande a été transmise au service financier pour validation`;
        } else {
            messageDiv.textContent = `Merci ${nom} ${prenom}, votre demande a été transmise au service des achats`;
        }
        formulaire.parentNode.insertBefore(messageDiv, formulaire.nextSibling);
        //nextSibling =  JavaScript qui désigne le nœud juste après l’élément courant dans le DOM (Document Object Model) Cela insère le message juste après le formulaire dans la page
    } catch (e) {
        // Affichage du message d'erreur avec la couleur --crm-alert
        messageDiv = document.createElement("div");
        messageDiv.id = "form-message";
        messageDiv.className = "alert-crm";
        messageDiv.textContent = e.message;
        formulaire.parentNode.insertBefore(messageDiv, formulaire.nextSibling);
    }
});

resetButton.addEventListener("click", function () {
    formulaire.reset();
});
