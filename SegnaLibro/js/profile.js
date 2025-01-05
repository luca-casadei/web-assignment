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

    var saveInfoForm = document.querySelector('form:first-of-type');
    saveInfoForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.querySelector('form:first-of-type input[name="name"]').value;
        const lastname = document.querySelector('form:first-of-type input[name="lastname"]').value;
        const avenue = document.querySelector('form:first-of-type input[name="avenue"]').value;
        const civic = document.querySelector('form:first-of-type input[name="civic"]').value;
        const city = document.querySelector('form:first-of-type input[name="city"]').value;
        const province = document.querySelector('form:first-of-type input[name="province"]').value;
        const cap = document.querySelector('form:first-of-type input[name="cap"]').value;
        const region = document.querySelector('form:first-of-type input[name="region"]').value;
        changeInfo(name, lastname, avenue, civic, city, province, cap, region);
    })

    var changePasswordLink = document.querySelector('form:first-of-type a');
    changePasswordLink.addEventListener('click', (e) => {
        e.preventDefault();
        toggleChangePasswordForm();
    });
    var changePasswordLink = document.querySelector('aside:first-of-type a');
    changePasswordLink.addEventListener('click', (e) => {
        e.preventDefault();
        toggleChangePasswordAside();
    });


    getGeographicData();
});

function toggleChangePasswordAside() {
    var changePasswordLink = document.querySelector('aside:first-of-type a');
    var changePasswordForm = document.querySelector('form:last-of-type');
    changePasswordLink.innerHTML = (changePasswordForm.style.display == 'block') ? 'Modifica Password' : 'Annulla cambio password';
    changePasswordForm.style.display = (changePasswordForm.style.display == 'block') ? 'none' : 'block';
}

function toggleChangePasswordForm() {
    var changePasswordLink = document.querySelector('form:first-of-type a');
    var changePasswordForm = document.querySelector('form:last-of-type');
    changePasswordLink.innerHTML = (changePasswordForm.style.display == 'block') ? 'Modifica Password' : 'Annulla cambio password';
    changePasswordForm.style.display = (changePasswordForm.style.display == 'block') ? 'none' : 'block';
}

async function changePassword(old_password, new_password, new_password_confirm) {
    const url = "./apis/api-profile.php";
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

async function changeInfo(name, lastname, avenue, civic, city, province, cap, region) {
    const url = "./apis/api-profile.php";
    const formData = new FormData();
    formData.append('name', name);
    formData.append('lastname', lastname);
    formData.append('address_avenue', avenue);
    formData.append('address_civic', civic);
    formData.append('address_city', city);
    formData.append('address_province', province);
    formData.append('address_cap', cap);
    formData.append('address_region', region);
    try{
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if(!response.ok){
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        document.querySelector('form:first-of-type p:last-of-type').innerHTML = json["profile_alert"];
    } catch (error) {
        console.log(error.message);
    }
}

async function getGeographicData() {
    const url = './apis/api-profile.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        
        const provincesSelect = document.querySelector('#address_province');
        const regionsSelect = document.querySelector('#address_region');
        
        provincesSelect.innerHTML = '<option value="">Seleziona la provincia</option>';
        json["provinces"].forEach(province => {
            const option = document.createElement('option');
            option.value = province.Codice; 
            option.textContent = province.Nome;  
            provincesSelect.appendChild(option);
        });

        regionsSelect.innerHTML = '<option value="">Seleziona la regione</option>';
        json["regions"].forEach(region => {
            const option = document.createElement('option');
            option.value = region.Codice;
            option.textContent = region.Nome;  
            regionsSelect.appendChild(option);
        });

    } catch (error) {
        console.log(error.message);
    }
}

