document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');

    const profileButton = nav.querySelector('img[alt="Accesso e Profilo"]');

    profileButton.addEventListener('click', () => {
        window.location.href = './profile_index.php'; 
    });

    const toggleButton = nav.querySelector('img[alt="Apri navigazione"]');

    toggleButton.addEventListener('click', () => {
        const navAtt = 'data-open';
        nav.setAttribute(navAtt, nav.getAttribute(navAtt) === "false" ? "true" : "false");
    });
});
