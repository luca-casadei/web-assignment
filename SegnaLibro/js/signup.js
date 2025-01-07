function generateSignupForm(){
    const form =`
    <h1>Registrazione</h1>
    <form action="#" method="POST">
        <ul>
            <li>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" required>
            </li>
            <li>
                <label for="cognome">Cognome:</label>
                <input type="text" id="cognome" required>
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" id="email" required>
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" id="password" required>
            </li>
            <li>
                <label for="conferma-password">Conferma password:</label>
                <input type="password" id="conferma-password" required>
            </li>
            <li>
                <input type="submit" value="Registrati">
            </li>
        </ul>
        <p></p>
    </form>`
    return form;
}

function showSignUpForm() {
    let form = generateSignupForm();
    const main = document.querySelector("main");
    main.innerHTML = form;
    document.querySelector("main form").addEventListener("submit", event => {
        event.preventDefault();
        const username = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        const name = document.querySelector("#nome").value;
        const surname = document.querySelector("#cognome").value;
        const confirmPassword = document.querySelector("#conferma-password").value;
        signup(username, password,name,surname,confirmPassword);
    });
}

async function signup(username, password, name, surname, cp) {
    const url = './apis/api-signup.php';
    const formData = new FormData();
    formData.append('email', username);
    formData.append('password', password);
    formData.append('conferma-password', cp);
    formData.append('nome', name);
    formData.append('cognome', surname);
    try {

        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        let status = "";

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        if (json["signuperror"]){
            document.querySelector("form > p").innerText = json["signuperror"];
        }
        else{
            window.location.href = "./login_index.php";
        }
    } catch (error) {
        console.log(error.message);
    }
}

showSignUpForm();