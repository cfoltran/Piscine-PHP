let button = document.querySelectorAll('input');
let toDo = document.getElementById('toDo');
let modal = document.getElementById('confirmation');

button[0].addEventListener("click", callback => {
    let toAdd = prompt("Ajouter une douceur");
    let node = toDo.cloneNode(true);
    node.textContent = toAdd.toUpperCase();
    toDo.prepend(node);
});

function remove() {
    this.parentNode.parentNode.removeChild(this.parentNode);
}

toDo.addEventListener("click", callback => {
    modal.style.display = "block";
    button[1].addEventListener("click", callback => {
        
    });
});

button[2].addEventListener("click", callback => {
    modal.style.display = "none";
});
