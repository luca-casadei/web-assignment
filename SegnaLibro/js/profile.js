document.addEventListener('DOMContentLoaded', () => {
    console.log("Profile page loaded");
    var changePasswordForm = document.querySelector('form:last-of-type');
    changePasswordForm.style.display = 'none';

    changePasswordForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const old_password = document.querySelector('form:last-of-type input[name="old_password"]').value;
        const new_password = document.querySelector('form:last-of-type input[name="new_password"]').value;
        const new_password_confirm = document.querySelector('form:last-of-type input[name="new_password_confirm"]').value;
        changePassword(old_password, new_password, new_password_confirm);
    });

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

async function changePassword(old_password, new_password, new_password_confirm) {
    const url = "api-profile.php";
    const formData = new FormData();
    formData.append('old_password', old_password);
    formData.append('new_password', new_password);
    formData.append('new_password_confirm', new_password_confirm);
    try{
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if(!response.ok){
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        document.querySelector('form:last-of-type').reset();
        document.querySelector('form:last-of-type p:last-of-type').innerHTML = json["profile_alert"];
    } catch (error) {
        console.log(error.message);
    }
}