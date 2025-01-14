function generateArticles(data) {
    let result = `
    <section>
    <h1>Ordine n. ${data.articles[0]["CodiceOrdine"]}</h1>
    `;
    for (let i = 0; i < data.articles.length; i++) {
        let article = `
        <article>
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
        <p>Prezzo totale: <span>${data["prezzoTotale"]}€</span></p>
        <p>Data ordine: <span>${data["DataOrdine"]}</span></p>
        <p>N. articoli: <span>${data.articles.length}</span></p>
        <p>Stato: <span>${data["stato"]}</span></p>
    </section>`;

    return result;
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
