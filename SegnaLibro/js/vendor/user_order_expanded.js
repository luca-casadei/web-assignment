function generateArticles(data) {
    let result = `<h1>Ordine n. ${data[0]["CodiceOrdine"]}</h1>`;
    for (let i = 0; i < data.length; i++) {
        let article = `
        <article>
            <header>
                <h2>${data[i]["Titolo"]}</h2>
                <p>${data[i]["DataAnnuncio"]}</p>
            </header>
            <div>
                <figure>
                    <img src="${data[i]["Immagine"]}" alt="" />
                </figure>
                <p>${data[i]["Descrizione"]}</p>
            </div>
            <footer>
                <p>Prezzo: <span>${data[i]["Prezzo"]}€</span></p>
            </footer>
        </article>
        `;
        result += article;
    }


    return result;
}

async function getExpandedOrder() {
    console.log("getExpandedOrder");
    const url = './apis/vendor/api-user_order-expanded.php';
    try {
        const formData = new FormData();
        formData.append('getArticles', true);
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        const json = await response.json();
        const data = generateArticles(json);
        document.querySelector("main").innerHTML = data;
    } catch (error) {
        console.log(error.message);
    }
}

getExpandedOrder();