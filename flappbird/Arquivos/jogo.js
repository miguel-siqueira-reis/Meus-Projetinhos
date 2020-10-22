console.log('[Miguel Siqueira Reis, prof: devsoutinho] Flappy Bird');
console.log('Inscreva-se no canal dele :D https://www.youtube.com/channel/UCzR2u5RWXWjUh7CwLSvbitA');

var frames = 0;
const sprites = new Image();
const som_hit = new Audio();
sprites.src = './sprites.png';
som_hit.src = './efeitos/hit.wav'

const canvas = document.querySelector('canvas');
const contexto = canvas.getContext('2d');
// bird
function flapCreate() {
    const flapBird = {
        spriteX: 0,
        spriteY: 0,
        spriteW: 33,
        spriteH: 24,
        canvasX: 10,
        canvasY: 10,
        canvasW: 33,
        canvasH: 34,
        gravidade: 0.35,
        velocidade: 0,
        pulo: 5.6,
        frameBird: 0,
        stop: false,
        moviment: [
            { spriteX: 0, spriteY: 0, },
            { spriteX: 0, spriteY: 26, },
            { spriteX: 0, spriteY: 52, },
        ],
        updateFrame() {
            const frameOk = frames % 10 == 0;
            if (frameOk && flapBird.stop == false) {
                const baseIncrement = 1;
                const increment = baseIncrement + flapBird.frameBird;
                const baseRepeat = flapBird.moviment.length;
                flapBird.frameBird = increment % baseRepeat;
            }
        },
        outGame() {
            if (flapBird.canvasY > 340 || flapBird.canvasY < 1) {
                som_hit.play();
                return true;
            }
            return false;
        },
        jump() {
            flapBird.velocidade = -flapBird.pulo;
        },
    
        update() {
            flapBird.velocidade += flapBird.gravidade;
            flapBird.canvasY += flapBird.velocidade
        },
    
        draw() {
            flapBird.updateFrame();
            const { spriteX, spriteY } = flapBird.moviment[flapBird.frameBird];
            contexto.drawImage(
                sprites, //Sprite de exemplo
                spriteX, spriteY, //A posição dele dentro do sprite
                flapBird.spriteW, flapBird.spriteH, ///O tamanho dele dentro do sprite
                flapBird.canvasX, flapBird.canvasY, //A posição dele dentro do canvas
                flapBird.canvasW, flapBird.canvasH //E o tamanho dentro do canvas
            ); 
        }
    }
    return flapBird;
}

//floor
function floorCreate() {
    const floor = {
        spriteX: 0,
        spriteY: 610,
        spriteW: 224,
        spriteH: 112,
        canvasX: 0,
        canvasY: canvas.height - 112,
        canvasW: 610,
        canvasH: 224,
        moveFloor: 1,
        update() {
            floor.canvasX -= floor.moveFloor;
            const repeatFloor = floor.canvasW / 2.1;
            const move = floor.canvasX - floor.moveFloor;
            floor.canvasX = move % repeatFloor;
        },
        draw() {
            contexto.drawImage(
                sprites, //Sprite de exemplo
                floor.spriteX, floor.spriteY, //A posição dele dentro do sprite
                floor.spriteW, floor.spriteH, ///O tamanho dele dentro do sprite
                floor.canvasX, floor.canvasY, //A posição dele dentro do canvas
                floor.canvasW, floor.canvasH //E o tamanho dentro do canvas
            ); 
        }
    
    }
    return floor;
}
// background from game
const backgroundGame = {
    spriteX: 390,
    spriteY: 0,
    spriteW: 275,
    spriteH: 204,
    canvasX: 0,
    canvasY: canvas.height - 204,
    canvasW: 375,
    canvasH: 204,
    draw() {
        contexto.fillStyle = '#70C5CE'
        contexto.fillRect(0, 0, canvas.width, canvas.height)
        contexto.drawImage(
            sprites, //Sprite de exemplo
            backgroundGame.spriteX, backgroundGame.spriteY, //A posição dele dentro do sprite
            backgroundGame.spriteW, backgroundGame.spriteH, ///O tamanho dele dentro do sprite
            backgroundGame.canvasX, backgroundGame.canvasY, //A posição dele dentro do canvas
            backgroundGame.canvasW, backgroundGame.canvasH //E o tamanho dentro do canvas
        ); 
    }

}

// start game
const startGame = {
    spriteX: 134,
    spriteY: 0,
    spriteW: 174,
    spriteH: 152,
    canvasX: (canvas.width / 2) -174 / 2,
    canvasY: 50,
    canvasW: 174,
    canvasH: 152,
    draw() {
        contexto.drawImage(
            sprites, //Sprite de exemplo
            startGame.spriteX, startGame.spriteY, //A posição dele dentro do sprite
            startGame.spriteW, startGame.spriteH, ///O tamanho dele dentro do sprite
            startGame.canvasX, startGame.canvasY, //A posição dele dentro do canvas
            startGame.canvasW, startGame.canvasH //E o tamanho dentro do canvas
        ); 
    }
}

function pipesCreate() {
    const pipes = {
        
        spriteW: 52,
        spriteH: 400,
        floor: {
            spriteX: 0,
            spriteY: 169,
        },
        sky: {
            spriteX: 52,
            spriteY: 169,
        },
        spaceBetween: 90,
        draw() {
            pipes.pairs.forEach((pipe) => {
                const randomY = pipe.y;
                const pipeSkyX = pipe.x;
                const pipeSkyY = 0 + randomY;
                contexto.drawImage(
                    sprites, //Sprite de exemplo
                    pipes.sky.spriteX, pipes.sky.spriteY, //A posição dele dentro do sprite
                    pipes.spriteW, pipes.spriteH, ///O tamanho dele dentro do sprite
                    pipeSkyX, pipeSkyY, //A posição dele dentro do canvas
                    pipes.spriteW, pipes.spriteH //E o tamanho dentro do canvas
                ); 
                
                const pipeFloorX = pipe.x;
                const pipeFloorY = pipes.spriteH + pipes.spaceBetween + randomY;
                contexto.drawImage(
                    sprites, //Sprite de exemplo
                    pipes.floor.spriteX, pipes.floor.spriteY, //A posição dele dentro do sprite
                    pipes.spriteW, pipes.spriteH, ///O tamanho dele dentro do sprite
                    pipeFloorX, pipeFloorY, //A posição dele dentro do canvas
                    pipes.spriteW, pipes.spriteH //E o tamanho dentro do canvas
                ); 
            })

            
        },
        pairs: [],
        update() {
            if (frames % 100 == 0) {
                console.log("foi")
                pipes.pairs.push({
                    x: canvas.width,
                    y: -150 * (Math.random() + 1)
                })
            }

            pipes.pairs.forEach((pipe) => {
                pipe.x = pipe.x - 2;
            })
        },
    }
    return pipes;
}

//--------//
//-screens-//
//--------//
function changeScreen(newScreen) {
    currentScreen = newScreen;
}

flapBird = flapCreate();
floor = floorCreate();
pipes = pipesCreate();
const screens = {
    homeScreen: {
        draw() {
            startGame.draw();
            flapBird.draw();
        },

        update() {
            floor.update();
        },

        click() {
            changeScreen(screens.gameScreen)
        }
    },
    gameScreen: {
        draw() {
            flapBird.draw();
            pipes.draw();
        },
        update() {
            if (flapBird.outGame()) changeScreen(screens.gameOverScreen);
            flapBird.update();
            floor.update();
            pipes.update()
        },
        click() {
            flapBird.jump();
            
        }
    },
    gameOverScreen: {
        draw() {
            flapBird.stop = true;
            flapBird.draw();
            
        },
        update() {

        },
        click() {
            changeScreen(screens.homeScreen);
            flapBird = flapCreate();
            floor = floorCreate();
            pipes = pipesCreate();
        }
    }
}



// loop
function loopframe() {
    frames++;
    backgroundGame.draw();
    floor.draw();

    currentScreen.draw();
    currentScreen.update();

    requestAnimationFrame(loopframe);
};
changeScreen(screens.homeScreen);
loopframe();


// event 
window.addEventListener('click', () =>{
    if(currentScreen.click) {
        currentScreen.click()
    }
});