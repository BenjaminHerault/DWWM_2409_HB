fetch("./assets/info.json")
.then(reponse => reponse.json())
// .then(data => {console.log(data[1].id);})
// .catch(error => console.error(error));

let rajouterStyle = document.querySelector("#rajouter");
let monTexte = document.createElement("p");
monTexte.setAttribute("id", "monTexte");
monTexte.textContent = "Identifiant ou mot de passe incorrect";
rajouterStyle.appendChild(monTexte);
