function generateOrders(data) {
    let result = `
        <section>
    `;

    let orders = data.orders;
    if (orders.length !== 0) {
        result += `
            <h1>I tuoi Ordini</h1>`;
        for (let i = 0; i < orders.length; i++) {
            let article = `
            <article>
                <header>
                    <h2>Ordine n. ${orders[i]["Codice"]}</h2>
                    <p>${orders[i]["DataOrdine"]}</p>
                </header>
                <p>Numero articoli: ${orders[i]["Count"]}</p>
                <p>Stato: ${orders[i]["Stato"]}</p>
                <footer>
                    <input type="button" value="Visualizza ordine"/>
                    <p>Prezzo: ${orders[i]["PrezzoTotaleOrdine"]}€</p>
                </footer>
            </article>
            `;
            result += article;
        }
        result += "</section>";
    } else {
        result += "<p>Non hai eseguito alcun ordine.</p></section>";
    }

    return result;
}

async function getOrdersData() {
    console.log("getOrdersData");
    const url = './apis/api-orders.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const data = generateOrders(json);
        document.querySelector("main").innerHTML = data;
    } catch (error) {
        console.log(error.message);
    }
}

getOrdersData();