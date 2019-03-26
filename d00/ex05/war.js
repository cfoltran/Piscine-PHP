var playground = document.getElementById('playground');
alert(playground);
var monster = document.querySelectorAll('.monter')[0];

function Monster() {
    this.element = monster.cloneNode(true);
    playground.appendChild(this.element);

    this.topMax = playground.offsetHeight - this.element.offsetHeight;
    this.topMin = 0;
    this.topMax = playground.offsetWidth - this.element.offsetWidth;
    this.leftMin = 0;

    this.element.style.top = this.randomDistance('top') + 'px';
    this.element.style.left = this.randomDistance('left') + 'px';
    this.element.toMonstre = this;

    this.timer = setTimeout(function() {
        gameOver();
    }, 5000);
    
    this.element.addEventListener('click', function() {
        var monstre = this.toMonstre;
        score.add(1);
        clearTimeout(monstre.timer);
        this.remove();
    });

    this.age = setTimeout(function() {style.backgroundColor='red'}, 3500);
}

Monster.prototype.randomDistance = function(point) {
    var max = this[point+'Max'];
    var min = this[point+'Min'];
    return Math.floor(Math.random() * (max - min + 1) + min);
}

alert(playground);
playground.removeChild(monster);

for (var i = 0 ; i < 2 ; i++) {
    var monstre = new Monstre;
}

var horloge;
var time = 0;
var ticTac = 500;

function action() {
    time += 1;
    if (time % 2 == 0) 
        new Monstre;
    horloge = setTimeout(function() { 
        action();
    }, ticTac);
}

var over = false;

function gameOver() {
    if (!over) {
        over = true;
        alert('Fin du jeu');
        clearTimeout(horloge);
    }
}