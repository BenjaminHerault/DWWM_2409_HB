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
