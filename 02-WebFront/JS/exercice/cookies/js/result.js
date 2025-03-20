const information = document.querySelector(".info");

function recupCookie(cle) {
  let resultat = " utilisateur non trouvé";
  let tabCookies = document.cookie.split(";");
  for (let i = 0; i < tabCookies.length; i++) {
    let tabCleValeur = tabCookies[i].split("=");
    if (tabCleValeur[0] == cle) {
      resultat = tabCleValeur[1];
      break;
    }
  }
  return resultat;
}

let nom = recupCookie("Nom");
information.textContent = " Bonjour M(e) " + nom + "  sur notre page client";