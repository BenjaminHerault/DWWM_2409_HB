const reponse = await fetch("./data/collectionPays.json");
console.log(reponse);
const monTbody = document.getElementById("mesPays");
const collectionPays = await reponse.json();
console.log(collectionPays);


function ajouterUneCelluleDonnee(ligne, texte){
    let celluleInfo = ligne.insertCell();
    celluleInfo.textContent = texte;
    return celluleInfo;
}


 for(let i=0; i<collectionPays.length;i++){
    const ligne = document.createElement("tr");
    monTbody.appendChild(ligne);
    ajouterUneCelluleDonnee(ligne, collectionPays[i].country_code);
    ajouterUneCelluleDonnee(ligne, collectionPays[i].country_name);
    monTbody.appendChild(ligne);
 };


// collectionPays.forEach(pays => {
//     const infoPays = document.createElement("div");
//     infoPays.innerHTML = `
//         <p>${pays.country_code}</p>
//         <p>${pays.country_name}</p>
//     `;
//     monTbody.appendChild(infoPays);
// });

