function generateCartArticles(data) {
    let result = `
        <div>
    `;

    let articles = data.articles;
    if (articles.length !== 0) {
        result += `  
            <p>Totale: ${data.total_price}</p><input type="button" value="Procedi all\'ordine" onclick="redirectToPayment()" />
        </div>
        <section>
            <h1>Carrello</h1>`;
        result += `<p>Totale: ${data.total_price}</p><input type="button" value="Procedi all\'ordine" />`;
        for (let i = 0; i < articles.length; i++) {
            let article = `
            <article>
                <header>
                    <figure>
                        <img src="${articles[i]["NomeImmagine"]}" alt="" />
                    </figure>
                    <h2>${articles[i]["TitoloAnnuncio"]}</h2>
                    <p>${articles[i]["NomeAutore"]} ${articles[i]["CognomeAutore"]}</p>
                    <input type="button" 
                        alt="Rimuovi articolo dal carrello" 
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
        result += "</section>";
    } else {
        result += "<p>Il carrello è vuoto</p></div><section><p>Il carrello è vuoto</p></section>";
    }

    return result;
}

async function getCartArticlesData() {
    console.log("getCartArticlesData");
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