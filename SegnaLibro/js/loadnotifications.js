function generateNotifications(notifications){
    let result = "";
    for(i = 0; i < notifications.length; i++){
        result += `
            <article onclick="expandOrder(${notifications[i]["CodiceOrdine"]})">
                <header>
                    <h2>${notifications[i]["Titolo"]}</h2>
                </header>
                <p>${notifications[i]["Testo"]}</p>
                <footer>
                    <p>Numero ordine: <span>${notifications[i]["CodiceOrdine"]}</span></p>
                </footer>
            </article>
        `;
    }
    if (result === ""){
        result = "Nessuna notifica da mostrare."
    }
    return result;
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


async function getNotifications(){
    try{
        const url = "./apis/api-getnotifications.php";
        const response = await fetch(url);
        if (!response.ok){

        }
        else{
            const json = await response.json();
            let mainContent = generateNotifications(json);
            document.querySelector("main").innerHTML = mainContent
        }
    }catch(e){
        console.log(e.message);
    }
}

getNotifications();