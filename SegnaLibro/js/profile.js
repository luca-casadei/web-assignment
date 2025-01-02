document.addEventListener('DOMContentLoaded', () => {
    console.log("Profile page loaded");
    var changePasswordForm = document.querySelector('form:last-of-type');
    changePasswordForm.style.display = 'none';

    var changePasswordLink = document.querySelector('form:first-of-type a');
    changePasswordLink.addEventListener('click', (e) => {
        e.preventDefault();
        toggleChangePasswordForm();
    });
});


function toggleChangePasswordForm() {
    var changePasswordLink = document.querySelector('form:first-of-type a');
    var changePasswordForm = document.querySelector('form:last-of-type');
    changePasswordLink.innerHTML = (changePasswordForm.style.display == 'block') ? 'Modifica Password' : 'Annulla cambio password';
    changePasswordForm.style.display = (changePasswordForm.style.display == 'block') ? 'none' : 'block';
}