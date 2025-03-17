let utilisateurs = [];
let email = [];
let motDePasses = [];
let utilisateursValider = document.querySelector("#utilisateurs");
let motDePasseValider = document.querySelector("#MDP");
let ConnextionValider = document.querySelector("#btnConnexion");
let divRajouterStyle = document.querySelector("#containerP");
let Avalider = false

fetch("./assets/info.json").then(reponse => reponse.json()).then(data => {
    for(let i = 0; i < data.length; i++){
        let prenom = data[i].firstname.toLowerCase();
        let nom = data[i].lastname.toLowerCase();
        utilisateurs.push(prenom + "." + nom);
       //console.log(utilisateurs);
        motDePasses.push(data[i].password);
       // console.log(motDePasses);
       
    }
    ConnextionValider.addEventListener("click", function(){
        for(let i = 0; i < data.length; i++){
            if(utilisateurs[i] === utilisateursValider.value && motDePasses[i] === motDePasseValider.value){
                console.log("C'est bon");
                Avalider = true;
                connextionReussi(data[i]);
            } 
        }
        if(Avalider === false){
            console.log("C'est pas bon");
            pasValider();
        }
    });
}).catch(error => console.error(error));
// .then(data => {console.log(data[1].id);})
// .catch(error => console.error(error));
function pasValider(){
    let monTexte = document.createElement("p");
    monTexte.setAttribute("id", "monTexte");
    monTexte.textContent = "utilisateurs ou mot de passe incorrect";
    divRajouterStyle.appendChild(monTexte);
    setTimeout(() => {
        monTexte.remove();
    }, 5000);
}
function connextionReussi(objet){
    let fielASupprime = document.querySelector("#fielForm");
    fielASupprime.setAttribute("style", "display:none");
    let texteConnextion = document.createElement("p");

    let deconnexion = document.createElement("button");
    deconnexion.textContent = "Déconnexion";
    deconnexion.setAttribute("id", "deconnexion");

    texteConnextion.innerHTML = "<br>Bonjour"+ " " +objet.lastname +" "+ objet.firstname;
    divRajouterStyle.appendChild(texteConnextion);
    divRajouterStyle.appendChild(deconnexion);

    deconnexion.addEventListener("click", function(){
        fielASupprime.setAttribute("style", "display:block");
        texteConnextion.remove();
        deconnexion.remove();
        utilisateursValider.value = "";
        motDePasseValider.value = "";
        utilisateursValider.focus();
        Avalider = false;
        monTabl.remove();

    });
}
function creerTableau(data){
     // creation du tableau
     let monTabl = document.createElement("table");
     monTabl.setAttribute("id", "monTabl");
     divRajouterStyle.appendChild(monTabl);
     
     // creation du thead
     let monThead = monTabl.createTHEad();
     // creation du tr
     let monTr = monThead.insertRow(); 
     // creation du th
     let thTableau = document.createElement("th");
     let textTableau = ["Nom", "Prénom", "Date de naissance", "Email", "Salaires"]; 
     for(let i = 0; i < textTableau.length; i++){
         thTableau = document.createElement("th");
         thTableau.textContent = textTableau[i];
         monTr.appendChild(thTableau);
     }
     // creation du tbody
     let monTbody = monTabl.createTBody();
     // creation du tr
     // creation du td
     for (let i = 0; i < utilisateurs.length; i++) {
         let monTrBody = monTbody.insertRow();
      //   let infoTableau = [objet.lastname, objet.firstname, objet.birthdate, objet.email, objet.salary];
         for(let i = 0; i < infoTableau.length; i++){
             tdTableau = document.createElement("td");
             tdTableau.textContent = infoTableau[i];
             monTrBody.appendChild(tdTableau);
         }   
     }
        // for(let i = 0; i < objet.length; i++){
        //     let prenom = objet.firstname.toLowerCase();
        //     let nom = objet.lastname.toLowerCase();
        //     email.push(prenom + "." + nom+"@example.com");
        //     console.log(email);
        // }

        deconnexion.addEventListener("click", function(){
            Avalider = false;
            monTabl.remove();
        });

}

