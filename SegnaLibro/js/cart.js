function generateCartArticles(data) {
    let result = `
    <h1>Carrello</h1>
    <p>Totale: ${data.total_price}</p>
    <input type="button" value="Procedi all'ordine" />
    `;

    let articles = data.articles;
    for (let i = 0; i < articles.length; i++) {
        let article = `
        <article>
            <header>
                <figure>
                    <img src="${articles[i]["NomeImmagine"]}" alt="" />
                </figure>
                <h2>${articles[i]["TitoloAnnuncio"]}</h2>
                <p>${articles[i]["NomeAutore"]} ${articles[i]["CognomeAutore"]}</p>
                <p>${articles[i]["NomeCategoria"]}</p>
            </header>
            <p>
                ${articles[i]["DescrizioneAnnuncio"]}
            </p>
            <footer>
                <p>${articles[i]["Prezzo"]}</p>
                <p>Condizione:<span>${articles[i]["NomeCondizione"]}</span></p>
                <button class="remove-button">
                    <img src="./images/trash.png" alt="Remove" />
                </button>
            </footer>
        </article>
        `;
        result += article;
    }
    return result;
}

async function getCartArticlesData() {
    const url = './apis/api-cart.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const articles = generateCartArticles(json);
        document.querySelector("main").innerHTML = articles;
    } catch (error) {
        console.log(error.message);
    }
}

console.log("Cart page loaded");
getCartArticlesData();
