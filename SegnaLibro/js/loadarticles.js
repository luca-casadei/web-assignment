function generateArticles(articoli){
    let result = "";
    if (articoli.length == 0){
        result += "<p>Nessun annuncio disponibile.</p>"
    }else{
        for(let i=0; i < articoli.length; i++){
            let articolo = `
            <article onClick=\'expandArticles(\"${articoli[i]["EAN"]}\", \"${articoli[i]["CodiceEditoriale"]}\", \"${articoli[i]["CodiceTitolo"]}\", \"${articoli[i]["CodiceRegGroup"]}\", \"${articoli[i]["NumeroCopia"]}\")\'>
                <figure>
                    <img src="${articoli[i]["NomeImmagine"]}" alt="" />
                </figure>
                <div>
                    <header>
                        <h2>${articoli[i]["TitoloAnnuncio"]}</h2>
                        <p>${articoli[i]["NomeAutore"]} ${articoli[i]["CognomeAutore"]}</p>
                        <p>${articoli[i]["NomeCategoria"]}</p>
                    </header>
                    <p>
                        ${articoli[i]["DescrizioneAnnuncio"]}
                    </p>
                    <footer>
                        <p>Condizione:<span>${articoli[i]["NomeCondizione"]}</span></p>
                        <p>€ ${articoli[i]["Prezzo"]}</p>
                    </footer>
                </div>
            </article>
            `;
            result += articolo;
        }
    }
    return result;
}

async function getArticleData() {
    const url = './apis/api-articles.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const articoli = generateArticles(json);
        const main = document.querySelector("main");
        main.innerHTML = articoli;
    } catch (error) {
        console.log(error.message);
    }
}

async function expandArticles(ean, codiceEditoriale, codiceTitolo, codiceRegGroup, numeroCopia){
    const url = './apis/api-detailed-article.php';
    try {
        const formData = new FormData();
        formData.append("expandedarticledata", JSON.stringify({
            "EAN": ean,
            "CodiceEditoriale": codiceEditoriale,
            "CodiceTitolo": codiceTitolo,
            "CodiceRegGroup": codiceRegGroup,
            "NumeroCopia": numeroCopia
        }))

        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }else{
            window.location.href = "./book_details_index.php";
        }

    } catch (error) {
        console.log(error.message);
    }
}

getArticleData();