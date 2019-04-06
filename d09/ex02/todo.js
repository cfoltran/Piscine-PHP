
var ft_list = document.getElementById('ft_list');
var modal = document.getElementById('confirmation');
let inputs = document.querySelectorAll('input');
var cookies = [];

function del() {
    if (confirm("Supprimer cette douceur ?"))
        this.parentElement.removeChild(this);
}

let add = (todo) => {
    var newDiv = document.createElement("div");
    newDiv.innerHTML = todo;
    newDiv.addEventListener("click", del);
    ft_list.prepend(newDiv);
}

window.onload = () => {
    cookie = (document.cookie) ? JSON.parse(document.cookie) : null;
    cookie.forEach((e) => {
        add(e);
    });
};

inputs[0].addEventListener('click', () => {
    event.preventDefault();

    let input = prompt("Ajouter une nouvelle douceur");
    if (input.length === 0)
        return ;
    add(input);
    var newCookie = [];
    for (var i = 0; i < ft_list.childElementCount; i++)
        newCookie.unshift(ft_list.children[i].innerHTML);
    document.cookie = JSON.stringify(newCookie);
});