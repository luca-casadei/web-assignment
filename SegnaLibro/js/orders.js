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
                <p>Numero articoli: <span> ${orders[i]["Count"]}</span></p>
                <p>Stato: <span>${orders[i]["Stato"]}</span></p>
                <footer>
                    <input type="button" value="Visualizza ordine" onClick=\'expandOrder(${orders[i]["Codice"]})\'/>
                    <p>Prezzo: <span>${orders[i]["PrezzoTotaleOrdine"]}€</span></p>
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

async function expandOrder(codiceOrdine){
    const url = './apis/api-order-expanded.php';
    try {
        const formData = new FormData();
        formData.append('orderexpanded', JSON.stringify({
            "codiceOrdine": codiceOrdine
        }));
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            window.location.href = "./order_expanded_index.php";
        }
    } catch (error) {
        console.log(error.message);
    }
}

getOrdersData();