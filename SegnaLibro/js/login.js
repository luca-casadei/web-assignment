function generateLoginForm(){
    let form = `
    <h1>Login</h1>
    <form action="#" method="POST">
        <p></p>
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

async function getLoginData() {
    const url = './apis/api-login.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        showLoginForm();
    } catch (error) {
        console.log(error.message);
    }
}

const main = document.querySelector("main");
getLoginData();  

function showLoginForm() {
    let form = generateLoginForm();
    main.innerHTML = form;
    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        login(username, password);
    });
}

async function login(username, password) {
    const url = './apis/api-login.php';
    const formData = new FormData();
    formData.append('email', username);
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
        if(json["logged"]){
            console.log("Login già eseguito");
            window.location.href = "./profile_index.php";
        }
        else{
            document.querySelector("form > p").innerText = json["loginerror"];
        }


    } catch (error) {
        console.log(error.message);
    }
}
