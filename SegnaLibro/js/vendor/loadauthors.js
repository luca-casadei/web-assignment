function loadAuthors(authorsArray) {
    let options = "";
    authorsArray.forEach(author => {
        options += `<option value="${author.Codice}">${author.Nome} ${author.Cognome}</option>`;
    });
    options += `<option value="custom">Altro</option>`;
    return options;
}

async function getAuthorsData() {
    const url = "./apis/vendor/api-authors.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            const json = await response.json();
            const authorsHtml = loadAuthors(json);
            const authorSelect = document.querySelector("#authorSelect");
            authorSelect.insertAdjacentHTML("beforeend", authorsHtml);
        }
    } catch (error) {
        console.log(error.message);
    }
}

getAuthorsData();