window.onload = function () {
    loadPage('login');
};

function loadPage(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'pages/' + page + '.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('content').innerHTML = xhr.responseText;
        } else {
            document.getElementById('content').innerHTML = 'Errore nel caricamento della pagina.';
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');
    const openButton = nav.querySelector('button:first-of-type');
    const closeButton = nav.querySelector('button:last-of-type');

    openButton.addEventListener('click', () => {
        nav.setAttribute('data-open', 'true');
    });

    closeButton.addEventListener('click', () => {
        nav.setAttribute('data-open', 'false');
    });
});
