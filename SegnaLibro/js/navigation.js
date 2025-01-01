document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');

    const profileButton = nav.querySelector('img[alt="Profilo"]');

    profileButton.addEventListener('click', () => {
        window.location.href = './pages/profile.php'; 
    });

    const toggleButton = nav.querySelector('img[alt="Toggle menu"]');

    toggleButton.addEventListener('click', () => {
        const navAtt = 'data-open';
        nav.setAttribute(navAtt, nav.getAttribute(navAtt) === "false" ? "true" : "false");
    });
});
