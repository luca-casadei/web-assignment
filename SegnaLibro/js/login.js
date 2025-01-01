function generateLoginForm(loginerror = null){
    let form = `
    <h1>Login</h1>
    <form action="#" method="POST">
        <p error>${loginerror}</p>
        <ul>
            <li>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required />
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required />
            </li>
            <li>
                <input type="submit" value="Accedi" />
            </li>
            <li>Non hai un account?<a href="./signup_index.php">Registrati</a></li>
        </ul>
    </form>
    `
    return form;
}

function generateProfileInfo() {
    let form = `
        <h1>Account</h1>
        <p>Visualizza le informazioni rilevanti del tuo account e apporta modifiche.</p>
        <form method="POST" action="update_profile.php">
            <ul>
                <li>
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" />
                </li>
                <li>
                    <label for="lastname">Cognome</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" />
                </li>
                <li>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly />
                </li>
                <li>
                    <label for="address">Indirizzo</label>
                    <input type="text" id="address" name="address" placeholder="Via esempio, 50" />
                </li>
            </ul>
            <a href="change_password.php" class="change-password-link">Modifica Password</a>
            <input type="submit" value="Salva Modifiche" />
        </form>
        <a href="./pages/logout.php" class="logout-link">Disconnetti</a>
        `
return form;
}

async function getLoginData() {
    const url = 'api-login.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        if(json["logged"]){
            showProfileInfo();
        } else {
            showLoginForm();
        }
    } catch (error) {
        console.log(error.message);
    }
}

const main = document.querySelector("main");
getLoginData();

function showProfileInfo() {
    let profilo = g
    main.innerHTML = 
}

function showLoginForm() {
    let form = generateLoginForm();
    main.innerHTML = form;
    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#username").value;
        const password = document.querySelector("#password").value;
        login(username, password);
    });
}

async function login(username, password) {
    const url = 'api-login.php';
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);
    try {

        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        if(json["logineseguito"]){
            visualizzaArticoli(json["articoliautore"]);
        }
        else{
            document.querySelector("form > p").innerText = json["loginerror"];
        }
    } catch (error) {
        console.log(error.message);
    }
}