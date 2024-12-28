window.onload = function () {
    console.log("PROVA");
    loadPage('login');
};

function loadPage(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'pages/' + page + '.php', true);
    xhr.onload = function () {
        console.log("PROVA");
        if (xhr.status === 200) {
            console.log("DENTRO IF");
            document.querySelector('main').innerHTML = xhr.responseText;
        } else {
            document.querySelector('main').innerHTML = 'Errore nel caricamento della pagina.';
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');
    const openButton = nav.querySelector('input:first-of-type');
    const closeButton = nav.querySelector('input:last-of-type');

    openButton.addEventListener('click', () => {
        nav.setAttribute('data-open', 'true');
    });

    closeButton.addEventListener('click', () => {
        nav.setAttribute('data-open', 'false');
    });
});
