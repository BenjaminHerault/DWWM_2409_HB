// import { collectionCars } from './data/cars.js';

const reponse = await fetch('./data/cars.json');

console.log(reponse);

const collectionCars = await reponse.json();

console.log(collectionCars);

const inputVoiture = document.getElementById('carName');
const btnRecherche = document.getElementById('validate');



function lancerRecherche(event) {
    event.preventDefault();

    let voitureRecherche = inputVoiture.value.trim().toLowerCase();
    console.log(voitureRecherche);

    let resultat = collectionCars.filter(
        (uneVoiture) => uneVoiture.car_name.toLowerCase().includes(voitureRecherche)
    );
    

    // for(let uneVoiture of collectionCars){
    //     if(uneVoiture.car_name.toLowerCase().includes(voitureRecherche)){
    //         resultat.push(uneVoiture);
    // }

    console.log(resultat);
    
}


btnRecherche.addEventListener('click', lancerRecherche); {

};