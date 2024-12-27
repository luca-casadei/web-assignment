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
