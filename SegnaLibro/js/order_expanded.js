function generateArticles(data) {
    let result = `
    <section>
    <h1>Ordine n. ${data.articles[0]["CodiceOrdine"]}</h1>
    `;
    for (let i = 0; i < data.articles.length; i++) {
        let article = `
        <article onClick=\'expandArticles(\"${data.articles[i]["EAN"]}\", \"${data.articles[i]["CodiceEditoriale"]}\", \"${data.articles[i]["CodiceTitolo"]}\", \"${data.articles[i]["CodiceRegGroup"]}\", \"${data.articles[i]["NumeroCopia"]}\")\'>
            <header>
                <h2>${data.articles[i]["Titolo"]}</h2>
                <p>${data.articles[i]["DataAnnuncio"]}</p>
            </header>
            <div>
            `;
        if (data.articles[i]["NomeImmagine"] != null) {
            article += `
                <figure>
                    <img src="./images/upload/${data.articles[i]["NomeImmagine"]}" alt="" />
                </figure>
                `;
        }
        article += `
            <p>${data.articles[i]["Descrizione"]}</p>
            </div> 
            <footer>
                <p>Prezzo: <span>${data.articles[i]["Prezzo"]}€</span></p>
            </footer>
            </article>
            `;
        result += article;
    }
    result += `</section>
    <section>
        <h1>Dettagli ordine:</h1>
        <ul>
            <li>
                <p>Prezzo totale:</p> <span>${data["prezzoTotale"]}€</span>
            </li>
            <li>
                <p>Data ordine:</p> <span>${data["DataOrdine"]}</span>
            </li>
            <li>
                <p>N. articoli:</p> <span>${data.articles.length}</span>
            </li>
            <li>
                <p>Stato:</p> <span>${data["stato"]}</span>
            </li>
        </ul>
    </section>`;

    return result;
}

async function expandArticles(
    ean,
    codiceEditoriale,
    codiceTitolo,
    codiceRegGroup,
    numeroCopia
) {
    const url = "./apis/api-detailed-article.php";
    try {
        const formData = new FormData();
        formData.append(
            "expandedarticledata",
            JSON.stringify({
                EAN: ean,
                CodiceEditoriale: codiceEditoriale,
                CodiceTitolo: codiceTitolo,
                CodiceRegGroup: codiceRegGroup,
                NumeroCopia: numeroCopia,
            })
        );

        const response = await fetch(url, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            window.location.href = "./book_details_index.php";
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function getExpandedOrder() {
    const url = "./apis/api-order-expanded.php";
    try {
        const formData = new FormData();
        formData.append("getArticles", true);
        const response = await fetch(url, {
            method: "POST",
            body: formData,
        });
        const json = await response.json();
        const data = generateArticles(json);
        document.querySelector("main").innerHTML = data;
    } catch (error) {
        console.log(error.message);
    }
}

getExpandedOrder();
