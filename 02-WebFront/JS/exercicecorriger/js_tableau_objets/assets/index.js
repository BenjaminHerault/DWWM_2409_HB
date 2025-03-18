let utilisateurs = [];
let motDePasses = [];
let utilisateursValider = document.querySelector("#utilisateurs");
let motDePasseValider = document.querySelector("#MDP");
let ConnextionValider = document.querySelector("#btnConnexion");
let divRajouterStyle = document.querySelector("#containerP");
let Avalider = false;

fetch("./assets/info.json").then(reponse => reponse.json()).then(data => {
    for(let i = 0; i < data.length; i++){
        let prenom = data[i].firstname.toLowerCase();
        let nom = data[i].lastname.toLowerCase();
        utilisateurs.push(prenom + "." + nom);
        motDePasses.push(data[i].password);
    }
    ConnextionValider.addEventListener("click", function(){
        for(let i = 0; i < data.length; i++){
            if(utilisateurs[i] === utilisateursValider.value && motDePasses[i] === motDePasseValider.value){
                Avalider = true;
                connextionReussi(data[i], data);
            } 
        }
        if(Avalider === false){
            pasValider();
        }
    });
}).catch(error => console.error(error));

function pasValider(){
    let monTexte = document.createElement("p");
    monTexte.setAttribute("id", "monTexte");
    monTexte.textContent = "Identifiant ou mot de passe incorrect";
    divRajouterStyle.appendChild(monTexte);
    setTimeout(() => {
        monTexte.remove();
    }, 5000);
}

function connextionReussi(objet, data){
    let fielASupprime = document.querySelector("#fielForm");
    fielASupprime.setAttribute("style", "display:none");
    let texteConnextion = document.createElement("p");

    let deconnexion = document.createElement("button");
    deconnexion.textContent = "Déconnexion";
    deconnexion.setAttribute("id", "deconnexion");

    texteConnextion.innerHTML = "<br><br>Bonjour "+ objet.firstname +" "+ objet.lastname;
    divRajouterStyle.appendChild(texteConnextion);
    divRajouterStyle.appendChild(deconnexion);

    // Appeler la fonction pour créer le tableau
    creactionDuTableau(data, objet);

    deconnexion.addEventListener("click", function(){
        fielASupprime.setAttribute("style", "display:block");
        texteConnextion.remove();
        deconnexion.remove();
        let monTableauSupprimer = document.querySelector("#monTableau");
        if (monTableauSupprimer) {
            monTableauSupprimer.remove();
        };
        utilisateursValider.value = "";
        motDePasseValider.value = "";
        utilisateursValider.focus();
        Avalider = false;
    });
}

function creactionDuTableau(data, utilisateurConnecte){
    // Création d'une fonction pour ajouter une cellule de données
    function ajouterUneCelluleDonnee(ligne, texte, surbrillance = false){
        let celluleInfo = ligne.insertCell();
        celluleInfo.id = "celluleInfo";
        celluleInfo.textContent = texte;
        if (surbrillance) {
            celluleInfo.classList.add("surbrillance");
        }
        return celluleInfo;
    };

    // Création du tableau
    let monTableau = document.createElement("table");
    monTableau.setAttribute("id", "monTableau");
    divRajouterStyle.appendChild(monTableau);

    // Création du thead 
    let monThead = monTableau.createTHead();

    // Création de la ligne du thead
    let ligne = monThead.insertRow();

    // Création des th
    let texteTh = ["Nom", "Prénom", "Date de naissance", "Email", "Salaires"];
    
    for (let i = 0; i < texteTh.length; i++) {
        let monTh = document.createElement("th");
        monTh.textContent = texteTh[i];
        ligne.appendChild(monTh);
        monTh.setAttribute("id", "monTh");
    };

    // Création du tbody
    let monTbody = monTableau.createTBody();

    function uneAdresseMail(index){
        let lePrenom = data[index].firstname;
        let leNom = data[index].lastname;
        let Email = lePrenom.toLowerCase() + "." + leNom.toLowerCase() + "@example.com";
        console.log(Email);
        return Email;
    }

    // Ajout des données dans le tbody
    for(let i = 0; i < data.length; i++){
        ligne = monTbody.insertRow();
        let surbrillance = (data[i].firstname === utilisateurConnecte.firstname && data[i].lastname === utilisateurConnecte.lastname);
        ajouterUneCelluleDonnee(ligne, data[i].lastname, surbrillance); 
        ajouterUneCelluleDonnee(ligne, data[i].firstname, surbrillance); 
        ajouterUneCelluleDonnee(ligne, data[i].birthday, surbrillance);
        ajouterUneCelluleDonnee(ligne, uneAdresseMail(i), surbrillance); 
        ajouterUneCelluleDonnee(ligne, data[i].salary + " €", surbrillance);
    };
}