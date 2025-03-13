let utilisateurs = [];
let utilisateursValider = document.querySelector("#utilisateurs");
let motDePasses = [];
let motDePasseValider = document.querySelector("#MDP");
let ConnextionValider = document.querySelector("#btnConnexion");
let divRajouterStyle = document.querySelector("#containerP");
let Avalider = false

fetch("./assets/info.json").then(reponse => reponse.json()).then(data => {
    for(let i = 0; i < data.length; i++){
        let prenom = data[i].firstname.toLowerCase();
        let nom = data[i].lastname.toLowerCase();
        utilisateurs.push(prenom + "." + nom);
       // console.log(utilisateurs);
        motDePasses.push(data[i].password);
       // console.log(motDePasses);
    }
    ConnextionValider.addEventListener("click", function(){
        for(let i = 0; i < data.length; i++){
            if(utilisateurs[i] === utilisateursValider.value && motDePasses[i] === motDePasseValider.value){
                console.log("C'est bon");
                Avalider = true;
                connextionReussi(data[i]);

                // let texteConnextion = document.createElement("p");
                // texteConnextion.textContent = "Bonjour"+ " " +data[i].lastname + " " +data[i].firstname ;
                // rajouterStyle.appendChild(texteConnextion);
                // break;
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
    texteConnextion.innerHTML = "<br>Bonjour"+ " " +objet.lastname +" "+ objet.firstname+"<br>"+"Vous êtes connecté";
    divRajouterStyle.appendChild(texteConnextion);

}



