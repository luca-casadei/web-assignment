function generateArticles(data) {
    let result = `
    <div>
        <p>Prezzo totale: <span>${data["prezzoTotale"]}€</span></p>
        <p>Data ordine: <span>${data["dataOrdine"]}</span></p>
        <p>N. articoli: <span>${data.articles.length}</span></p>
    </div>
    <section>
    <h1>Ordine n. ${data.articles[0]["CodiceOrdine"]}</h1>
    <p>Prezzo totale: <span>${data["prezzoTotale"]}€</span></p>
    <p>Data ordine: <span>${data["dataOrdine"]}</span></p>
    <p>N. articoli: <span>${data.articles.length}</span></p>
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
        if (data.articles[i]["Immagine"] != null) {
            article += `
                <figure>
                    <img src="${data.articles[i]["Immagine"]}" alt="" />
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
    result += "</section>";

    return result;
}

async function getExpandedOrder() {
    console.log("getExpandedOrder");
    const url = "./apis/api-order-expanded.php";
    try {
        const formData = new FormData();
        formData.append("getArticles", true);
        const response = await fetch(url, {
            method: "POST",
            body: formData,
        });
        const json = await response.json();
        console.log(json);
        const data = generateArticles(json);
        document.querySelector("main").innerHTML = data;
    } catch (error) {
        console.log(error.message);
    }
}

getExpandedOrder();
