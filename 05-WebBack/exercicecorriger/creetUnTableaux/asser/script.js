let monBody = document.querySelector("body");

fetch("./asser/info.json").then(reponse => reponse.json()).then(data => {

    // creaction d'une fonction rajouter
    function ajouterUneCelluleDonnee(ligne, texte){
        let celluleInfo = ligne.insertCell();
        celluleInfo.textContent = texte;
        return celluleInfo;
    };

    // creaction du tableau
    let monTableau = document.createElement("table");
    monTableau.setAttribute("id", "monTableau");
    monBody.appendChild(monTableau);

    // creation du thead 
    let monThead = monTableau.createTHead();

    // creation de Tr
    let ligne = monThead.insertRow();

    // creation du th
    let texteTh = ["Nom", "Prénom", "Date de naissance", "Email", "Salaires"];
    for (let i = 0; i < texteTh.length; i++) {
        let monTh = document.createElement("th");
        monTh.textContent = texteTh[i];
        ligne.appendChild(monTh);
    };

    // creation du tbody
    let monTbody = monTableau.createTBody();

    function uneAdresseMail(index){
            let lePrenom = data[index].firstname;
            let leNom = data[index].lastname;
            let Email = lePrenom.toLowerCase() + "." + leNom.toLowerCase() + "@example.com";
            console.log(Email);
            return Email;
    }
    for(let i=0; i<data.length;i++){
        ligne = monTbody.insertRow();
        ajouterUneCelluleDonnee(ligne, data[i].lastname); 
        ajouterUneCelluleDonnee(ligne, data[i].firstname); 
        ajouterUneCelluleDonnee(ligne, data[i].birthday);
        ajouterUneCelluleDonnee(ligne, uneAdresseMail(i)); 
        ajouterUneCelluleDonnee(ligne, data[i].salary+" €");
    };

}).catch(error => console.error(error));
