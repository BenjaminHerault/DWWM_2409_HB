
// Carte de france
const Canvas = document.getElementById('mapCanvas');
const ctx = canvas.getContext('2d');

// Charger une image de carte
const img = new Image();
img.onload = function() {
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
};
img.onerror = function() {
    console.error('Erreur de chargement de l\'image.');
};
img.src = 'assets/image/carteDeFrance/Carte_France.png';


     
// Fonction pour ajouter des icônes
function addIcon(x, y) {
    const icon = new Image();
    icon.onload = function() {
        ctx.drawImage(icon, x - icon.width / 2, y - icon.height / 2);
    };
    icon.onerror = function() {
        console.error('Erreur de chargement de l\'icône.');
    };
    icon.src = 'assets/image/icone/icon.png';
}
 
// Ajouter des icônes aux positions souhaitées
const positions = [
    {x: 520, y: 135, src: 'assets/image/icone/icon1.png'},
    {x: 430, y: 242, src: 'assets/image/icone/icon2.png'},
    {x: 170, y: 262, src: 'assets/image/icone/icon3.png'},
    {x: 735, y: 270, src: 'assets/image/icone/icon4.png'},
    {x: 170, y: 364, src: 'assets/image/icone/icon5.png'},
    {x: 534, y: 490, src: 'assets/image/icone/icon6.png'},
    {x: 562, y: 690, src: 'assets/image/icone/icon7.png'},
    {x: 210, y: 520, src: 'assets/image/icone/icon6.png'}
];
 
positions.forEach(function(pos) {
    addIcon(pos.x, pos.y, pos.src);
});

//Menu Burger 

const sidenav = document.getElementById("mySidenav")
const openBtn = document.getElementById("openBtn")
const closeBtn = document.getElementById("closeBtn")

openBtn.addEventListener("click", openNav);
closeBtn.addEventListener("click", closeNav);

function openNav(e){
    e.preventDefault()
    sidenav.classList.add("active");
}

function closeNav(e){
    e.preventDefault()
    sidenav.classList.remove("active");
}





// Ceci est une fonction auto - exécutable.Les fonctions auto - exécutables
// sont des fonctions qui s'exécutent immédiatement après leur déclaration,
// sans avoir besoin d'être appelées.Les accolades immédiatement après la 
// déclaration de la fonction et les parenthèses à la fin de la déclaration 
// définissent la fonction et permettent de l'exécuter immédiatement.
(function () {
    // Utilisation de la directive "use strict" pour activer le mode strict en JavaScript
    // Cela implique une meilleure gestion des erreurs et une syntaxe plus stricte pour le code
    "use stict"
    // Déclare la constante pour la durée de chaque slide
    const slideTimeout = 5000;
    // Récupère tous les éléments de type "slide"
    const $slides = document.querySelectorAll('.slide');
    // Initialisation de la variable pour les "dots"
    let $dots;
    // Initialisation de la variable pour l'intervalle d'affichage des slides
    let intervalId;
    // Initialisation du slide courant à 1
    let currentSlide = 1;
    // Fonction pour afficher un slide spécifique en utilisant un index
    function slideTo(index) {
        // Vérifie si l'index est valide (compris entre 0 et le nombre de slides - 1)
        currentSlide = index >= $slides.length || index < 1 ? 0 : index;
        // Boucle sur tous les éléments de type "slide" pour les déplacer
        $slides.forEach($elt => $elt.style.transform = `translateX(-${currentSlide * 100}%)`);
        // Boucle sur tous les "dots" pour mettre à jour la couleur par la classe "active" ou "inactive"
        $dots.forEach(($elt, key) => $elt.classList = `dot ${key === currentSlide? 'active': 'inactive'}`);
    }
    // Fonction pour afficher le prochain slide
    function showSlide() {
        slideTo(currentSlide);
        currentSlide++;
    }
    // Boucle pour créer les "dots" en fonction du nombre de slides
    for (let i = 1; i <= $slides.length; i++) {
        let dotClass = i == currentSlide ? 'active' : 'inactive';
        let $dot = `<span data-slidId="${i}" class="dot ${dotClass}"></span>`;
        document.querySelector('.carousel-dots').innerHTML += $dot;
    }
    // Récupère tous les "dots"
    $dots = document.querySelectorAll('.dot');
    // Boucle pour ajouter des écouteurs d'événement "click" sur chaque "dot"
    $dots.forEach(($elt, key) => $elt.addEventListener('click', () => slideTo(key)));
    // Ajout d'un écouteur d'événement "click" sur le bouton "prev" pour afficher le slide précédent
    prev.addEventListener('click', () => slideTo(--currentSlide))
    // Ajout d'un écouteur d'événement "click" sur le bouton "next" pour afficher le slide suivant
    next.addEventListener('click', () => slideTo(++currentSlide))
    // Initialisation de l'intervalle pour afficher les slides
    intervalId = setInterval(showSlide, slideTimeout)
    // Boucle sur tous les éléments de type "slide" pour ajouter des écouteurs d'événement pour les interactions avec la souris et le toucher
    $slides.forEach($elt => {
        let startX;
        let endX;
        // Efface l'intervalle d'affichage des slides lorsque la souris passe sur un slide
        $elt.addEventListener('mouseover', () => {
            clearInterval(intervalId);
        }, false)
        // Réinitialise l'intervalle d'affichage des slides lorsque la souris sort d'un slide
        $elt.addEventListener('mouseout', () => {
            intervalId = setInterval(showSlide, slideTimeout);
        }, false);
        // Enregistre la position initiale du toucher lorsque l'utilisateur touche un slide
        $elt.addEventListener('touchstart', (event) => {
            startX = event.touches[0].clientX;
        });
        // Enregistre la position finale du toucher lorsque l'utilisateur relâche son doigt
        $elt.addEventListener('touchend', (event) => {
            endX = event.changedTouches[0].clientX;
            // Si la position initiale est plus grande que la position finale, affiche le prochain slide
            if (startX > endX) {
                slideTo(currentSlide + 1);
                // Si la position initiale est plus petite que la position finale, affiche le slide précédent
            } else if (startX < endX) {
                slideTo(currentSlide - 1);
            }
        });
    })
})()