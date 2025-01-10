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
        const province = document.querySelector('form:first-of-type select[name="province"]').value;
        const cap = document.querySelector('form:first-of-type input[name="cap"]').value;
        changeInfo(name, lastname, avenue, civic, city, province, cap);
    })

    var changePasswordLink = document.querySelector('form:first-of-type a');
    changePasswordLink.addEventListener('click', (e) => {
        e.preventDefault();
        toggleChangePasswordForm();
    });
    var changePasswordLink = document.querySelector('div:first-of-type a');
    changePasswordLink.addEventListener('click', (e) => {
        e.preventDefault();
        toggleChangePasswordDiv();
    });


    getProvinces();
    getUserData();
});

function toggleChangePasswordDiv() {
    var changePasswordLink = document.querySelector('div:first-of-type a');
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

async function changeInfo(name, lastname, avenue, civic, city, province, cap) {
    const url = "./apis/api-profile.php";
    const formData = new FormData();
    formData.append('name', name);
    formData.append('lastname', lastname);
    formData.append('address_avenue', avenue);
    formData.append('address_civic', civic);
    formData.append('address_city', city);
    formData.append('address_province', province);
    formData.append('address_cap', cap);
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

async function getProvinces() {
    const url = './apis/api-profile.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const provincesSelect = document.querySelector('#address_province');        
        provincesSelect.innerHTML = '<option value="">Seleziona la provincia</option>';
        json["provinces"].forEach(province => {
            const option = document.createElement('option');
            option.value = province.Codice; 
            option.textContent = province.Nome;  
            provincesSelect.appendChild(option);
        });
    } catch (error) {
        console.log(error.message);
    }
}

async function getUserData() {
    const url = './apis/api-profile.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const userInfo = json["user_info"][0];
        document.querySelector('#name').value = userInfo.Nome || "";
        document.querySelector('#lastname').value = userInfo.Cognome || "";
        document.querySelector('#email').value = userInfo.Email || "";
        document.querySelector('#address_avenue').value = userInfo.Via || "";
        document.querySelector('#address_civic').value = userInfo.Civico || "";
        document.querySelector('#address_city').value = userInfo.Citta || "";
        document.querySelector('#address_province').value = userInfo.CodiceProvincia || "";
        document.querySelector('#address_cap').value = userInfo.CAP || "";

    } catch (error) {
        console.log(error.message);
    }
}

