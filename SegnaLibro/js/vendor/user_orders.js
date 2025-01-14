function generateUserOrders(data) {
    let result = `
        <section>
    `;
    let orders = data.orders;
    if (orders && orders.length > 0) {
        result += `
                <h1>Ordini degli utenti</h1>`;
        for (let i = 0; i < orders.length; i++) {
            let ordineCorrente = orders[i];
            let singleOrder = `
            <article>
                <header>
                    <h2>Ordine n. ${orders[i]["Codice"]}</h2>
                    <p>${orders[i]["DataOrdine"]}</p>
                </header>
                <p>Stato: ${orders[i]["Stato"]}</p>
                <p>Email: ${orders[i]["Email"]}</p>
                <p>Numero libri: ${orders[i]["Count"]}</p>
                <footer>
                    <input type="button"
                        value="Visualizza libri"
                        onclick="expandUserOrder('${orders[i]["Codice"]}')"
                    />
                    <p>Totale: ${orders[i]["PrezzoTotaleOrdine"]} €</p>
                </footer>
            </article>
            `;
            result += singleOrder;
        }

        result += `
            </section>
        `;
    } else {
        result += `
        <h1>Nessun ordine trovato</h1>
        <section>
            <p>Non hai ordini al momento.</p>
        </section>
        `;
    }

    return result;
}

async function getUserOrdersData() {
    const url = './apis/vendor/api-user_orders.php';

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        const data = generateUserOrders(json);
        document.querySelector("main").innerHTML = data;
    } catch (error) {
        console.log(error.message);
    }
}

async function expandUserOrder(codiceOrdine) {
    const url = './apis/vendor/api-user_order-expanded.php';
    try {
        const formData = new FormData();
        formData.append('userorderexpanded', JSON.stringify({
            "codiceOrdine": codiceOrdine
        }));
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            window.location.href = "./user_order_expanded_index.php";
        }
    } catch (error) {
        console.log(error.message);
    }
}

getUserOrdersData();
