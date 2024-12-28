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
