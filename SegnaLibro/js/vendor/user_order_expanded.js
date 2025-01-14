function generateArticles(data) {
    let result = `
    
    <section>
    <h1>Ordine n. ${data.articles[0]["CodiceOrdine"]}</h1>`;
    for (let i = 0; i < data.articles.length; i++) {
        let article = `
        <article>
            <header>
                <h2>${data.articles[i]["Titolo"]}</h2>
                <p>${data.articles[i]["DataAnnuncio"]}</p>
            </header>
            <div>`;
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
        <input type="button" value="Segna come pronto" onclick="markAsReady(${data.articles[0]["CodiceOrdine"]})" />
    </section>`;
    return result;
}

async function getExpandedOrder() {
    const url = "./apis/vendor/api-user_order-expanded.php";
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

async function markAsReady(orderCode) {
    if (
        confirm(
            "Vuoi davvero segnare questo ordine come pronto alla consegna? L'azione è irreversibile"
        )
    ) {
        const url = "./apis/vendor/api-user_order-expanded.php";
        try {
            const formData = new FormData();
            formData.append("markAsReady", orderCode);
            const response = await fetch(url, {
                method: "POST",
                body: formData,
            });
            const text = await response.text();
            if (text === "SUCCESS") {
                alert("Ordine contrassegnato per la consegna.");
                window.location.href = "./user_orders_index.php";
            }
        } catch (error) {
            console.log(error.message);
        }
    }
}
