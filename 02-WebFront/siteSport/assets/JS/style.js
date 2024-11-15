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



// // Fonction pour ajouter des icônes
// function addIcon(x, y, iconSrc) {
//     const icon = new Image();
//     icon.onload = function() {
//         ctx.drawImage(icon, x - icon.width / 2, y - icon.height / 2);
//     };
//     icon.onerror = function() {
//         console.error('Erreur de chargement de l\'icône.');
//     };
//     icon.src = 'assets/image/icone/icon.png';

     
// Fonction pour ajouter des icônes
function addIcon(x, y, iconSrc) {
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
    {x: 100, y: 150, src: 'assets/image/icone/icon1.png'},
    {x: 200, y: 250, src: 'assets/image/icone/icon2.png'},
    {x: 300, y: 100, src: 'assets/image/icone/icon3.png'},
    {x: 400, y: 300, src: 'assets/image/icone/icon4.png'},
    {x: 500, y: 200, src: 'assets/image/icone/icon5.png'},
    {x: 600, y: 400, src: 'assets/image/icone/icon6.png'},
    {x: 700, y: 500, src: 'assets/image/icone/icon7.png'}
];
 
positions.forEach(function(pos) {
    addIcon(pos.x, pos.y, pos.src);
});
