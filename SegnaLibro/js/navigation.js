document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');

    const profileButton = nav.querySelector('nav > ul:last-of-type > li + li');
    const notificationButton = nav.querySelector('nav > ul:last-of-type > li:first-of-type');

    profileButton.addEventListener('click', () => {
        window.location.href = './profile_index.php'; 
    });

    notificationButton.addEventListener('click', () => {
        window.location.href = './notifications_index.php'
    })

    const toggleButton = nav.querySelector('img[alt="Apri navigazione"]');

    toggleButton.addEventListener('click', () => {
        const navAtt = 'data-open';
        nav.setAttribute(navAtt, nav.getAttribute(navAtt) === "false" ? "true" : "false");
    });
});
