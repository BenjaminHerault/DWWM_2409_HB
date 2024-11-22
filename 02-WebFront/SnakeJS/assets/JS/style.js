

const monCanvas = document.querySelector("canvas");
const context = monCanvas.getContext('2d');

let box = 20;

let snake = [];
snake[0] = {x: 10 * box, y: 10 * box};

let food = {
    x: Math.floor(Math.random() * 15 + 1) * box,
    y: Math.floor(Math.random() * 15 + 1) * box
};

let score = 0;

let d;

document.addEventListener("keydown", direction);

function direction(event) {
    let key = event.keyCode;
    if(key == 37 && d != 'right'){
        d = "left";
    }
    else if (key == 38 && d != "down"){
        d = "up";
    }
    else if (key == 39 && d != "left"){
        d = "right";
    }
    else if (key == 40 && d != "up"){
        d = "down";
    }
}

function draw() {
    context.clearRect(0, 0, 400, 400);

    // Dessiner le serpent
    for(let i = 0; i < snake.length; i++){
        context.fillStyle = (i == 0) ? "green" : "white";
        context.fillRect(snake[i].x, snake[i].y, box, box);
        context.strokeStyle = "red";
        context.strokeRect(snake[i].x, snake[i].y, box, box);
    }

    // Dessiner la nourriture
    context.fillStyle = "orange";
    context.fillRect(food.x, food.y, box, box);

    let snakeX = snake[0].x;
    let snakeY = snake[0].y;

    // Mise à jour de la position du serpent en fonction de la direction
    if(d == "left") snakeX -= box;
    if(d == "up") snakeY -= box;
    if(d == "right") snakeX += box;
    if(d == "down") snakeY += box;

    // Si le serpent mange la nourriture
    if(snakeX == food.x && snakeY == food.y){
        score++;
        food = {
            x: Math.floor(Math.random() * 15 + 1) * box,
            y: Math.floor(Math.random() * 15 + 1) * box
        };
    } else {
        snake.pop(); // Retirer la dernière partie du serpent
    }

    let newHead = {
        x: snakeX,
        y: snakeY
    };

    // Vérification des collisions
    if(snakeX < 0 || snakeY < 0 || snakeX > 19 * box || snakeY > 19 * box || collision(newHead, snake)){
        clearInterval(game);
        alert("Game Over! Score: " + score);
        return;
    }
    
    snake.unshift(newHead); // Ajouter la nouvelle tête du serpent

    // Affichage du score
    context.fillStyle = "red";
    context.font = "30px Arial";
    context.fillText(score, 2 * box, 1.6 * box);
}

function collision(head, array){
    for(let g = 0; g < array.length; g++){
        if(head.x == array[g].x && head.y == array[g].y) 
            return true;
    }
    return false;
}

let game = setInterval(draw, 100);



