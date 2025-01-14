function generateCartArticles(data) {
    let result = `
        <section>
    `;

    let articles = data.articles;
    if (articles.length !== 0) {
        result += `<h1>Carrello</h1>`;
        for (let i = 0; i < articles.length; i++) {
            let article = `
            <article>
                <header>
                    <figure>
                        <img src="${articles[i]["NomeImmagine"]}" alt="" />
                    </figure>
                    <h2>${articles[i]["TitoloAnnuncio"]}</h2>
                    <p>${articles[i]["NomeAutore"]} ${articles[i]["CognomeAutore"]}</p>
                    <label for="trashitem">Rimuovi dal carrello</label>
                    <input type="image" 
                        id="trashitem"
                        alt="Rimuovi elemento dal carrello"
                        src="./images/trash.png"
                        onclick="removeArticle('${articles[i]["NumeroCopia"]}', '${articles[i]["EAN"]}', '${articles[i]["CodiceRegGroup"]}', '${articles[i]["CodiceEditoriale"]}', '${articles[i]["CodiceTitolo"]}')"
                    />
                </header>
                <p>ISBN: ${articles[i]["EAN"]}-${articles[i]["CodiceRegGroup"]}-${articles[i]["CodiceEditoriale"]}-${articles[i]["CodiceTitolo"]}-${articles[i]["CifraControllo"]}</p>
                <p>${articles[i]["NomeCategoria"]}</p>
                <p>${articles[i]["DescrizioneAnnuncio"]}</p>
                <footer>
                    <p>${articles[i]["Prezzo"]}</p>
                    <p>Condizione: <span>${articles[i]["NomeCondizione"]}</span></p>
                </footer>
            </article>
            `;
            result += article;
        }
        result += `</section>
        <section>  
            <h1>Totale: ${data.total_price}€</h1>
            <input aria-label="Procedi all'ordine" type="button" value="Procedi all\'ordine" onclick="redirectToPayment()" />
        </section>`;
    } else {
        result += "</section><section><p>Il carrello è vuoto</p></section>";
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
        const data = generateCartArticles(json);
        document.querySelector("main").innerHTML = data;
    } catch (error) {
        console.log(error.message);
    }
}

async function removeArticle(numero_copia, ean, codice_reg_group, codice_editoriale, codice_titolo) {
    const url = './apis/api-cart.php';
    const data = new FormData();
    data.append('numero_copia', numero_copia);
    data.append('ean', ean);
    data.append('codice_reg_group', codice_reg_group);
    data.append('codice_editoriale', codice_editoriale);
    data.append('codice_titolo', codice_titolo);
    data.append('action', 'remove');
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        if (json.status === "success") {
            getCartArticlesData();
        }
    } catch (error) {
        console.log(error.message);
    }
}

function redirectToPayment() {
    window.location.href = "./checkout_index.php";
}

getCartArticlesData();