const game = {
    positions: ['','','','','','','','',''],
    sibols: ['x', 'o'],
    gameOver: false,
    divGame: document.querySelector('.game'),
    i: 0,
    iClick: 0,
    sequencias: [
        [0,1,2],
        [3,4,5],
        [6,7,8],
        [0,3,6],
        [1,4,7],
        [2,5,8],
        [0,4,3],
        [2,4,6]
    ],
    
    draw: function() {
        this.i = 0;
        this.positions.forEach(content => {
            this.divGame.innerHTML += `<div class="local__game${this.i} local__game" onclick="game.click(${this.i})">${content}</div>`;
            this.i++;
        })
    },
    
    reDraw: function() {
        this.i = 0;
        this.positions.forEach(content => {
            this.divGame.querySelector(`.local__game${this.i}`).innerHTML = content;
            this.i++;
        })
        this.i=0;
    },
    
    click: function(id) {
        if (!this.gameOver) {
            if (this.positions[id] == '') {
                this.positions[id] = this.sibols[this.iClick%2];
                console.log(`id:${id} i:${this.iClick} result:${this.iClick%2}`)
                this.iClick++;
                game.reDraw();
                this.isGameOver(this.iClick, 'x');
                this.isGameOver(this.iClick, 'o');
            }
        }
    },
    
    isGameOver: function(id, simbulo) {
        if (id == 9) {
            this.gameOver = true;
            this.endGamer();
            return;
        }
        this.i = 0;
        this.sequencias.forEach(itens => {
            itens.forEach(iten => {
                if (this.positions[iten] == simbulo) {
                    this.i++;
                    if (this.i == 3) {
                        this.gameOver = true;
                        this.endGamer(itens);
                        return;
                    }
                }

            })
            this.i = 0;
        })
    },
    
    endGamer: function(itens) {
        if (this.gameOver) {
            document.querySelector('.btn').classList.add('active');
            if (itens) {
                itens.forEach(iten => {
                    document.querySelector(`.local__game${iten}`).style = "color: red;";
                })
                return;
            }
            document.querySelectorAll('.local__game').forEach(iten => iten.style = "color: green;");
        }
    },
    
    reiniciaGame: function() {
        if (this.gameOver) {
            document.querySelectorAll('.local__game').forEach(iten => iten.style = "color: white;");
            this.positions = ['','','','','','','','',''];
            this.gameOver = false;
            this.i = 0;
            this.iClick = 0;
            document.querySelector('.btn').classList.remove('active');
            game.reDraw();
        }
    }
};

game.draw();
