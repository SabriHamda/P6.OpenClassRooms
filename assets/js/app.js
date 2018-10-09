const $ = require('jquery');

require('bootstrap');

window.addEventListener('scroll', function (e) {
    let windowScrollTop = this.scrollY;
    let imgPos = (windowScrollTop / -2 + 'px');
    let titlePos = (windowScrollTop / -1 + 'px');

    document.getElementById('main-header').style.transform = "translate(0, " + imgPos + ")";
    document.getElementById('header-title').style.transform = "translate(" + titlePos + " ,0)";

});

document.getElementById('message-btn').addEventListener('click', function (event) {
    event.preventDefault();
    hide(document.querySelectorAll('.message'));
});

function hide(elements) {
    elements = elements.length ? elements : [elements];
    for (let index = 0; index < elements.length; index++) {
        elements[index].style.display = 'none';
    }
}

