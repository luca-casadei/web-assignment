document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');

    const profileButton = nav.querySelector('img[alt="Profilo"]');

    profileButton.addEventListener('click', () => {
        window.location.href = './pages/profile.php'; 
    });

    const toggleButton = nav.querySelector('img[alt="Toggle menu"]');

    toggleButton.addEventListener('click', () => {
        console.log("click");
        const isOpen = nav.getAttribute('data-open') === 'true';
        nav.setAttribute('data-open', isOpen ? 'false' : 'true');
    });
});
