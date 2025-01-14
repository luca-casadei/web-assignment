function loadCopies(articoli) {
    var result = `
    <h1>Annunci per questo libro</h1>
    `;
    if (articoli.length !== 0){
        for(let i=0; i < articoli.length; i++){
            let articolo = `
            <article onClick=\'deleteArticle(\"${articoli[i]["EAN"]}\", \"${articoli[i]["CodiceEditoriale"]}\", \"${articoli[i]["CodiceTitolo"]}\", \"${articoli[i]["CodiceRegGroup"]}\", \"${articoli[i]["NumeroCopia"]}\")\'>
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
        document.querySelector("main > section:last-of-type > p:first-of-type > span").innerHTML = articoli[0]["Titolo"]
        document.querySelector("main > section:last-of-type > p:last-of-type > span").innerHTML = articoli[0]["DataPubblicazione"]
    }
    else{
        alert("Non ci sono annunci per questo libro.");
        window.location.href = "./index.php"
    }
    return result;
}

async function deleteArticle(ean, codiceEditoriale, codiceTitolo, codiceRegGroup, numeroCopia){
    if (confirm("Sei sicuro di voler cancellare questo annuncio?")){
        const url = "./apis/vendor/api-deletearticle.php";
        try{
            const formData = new FormData();
            formData.append("deletedetails", JSON.stringify({
                "EAN": ean,
                "CodiceRegGroup": codiceRegGroup,
                "CodiceTitolo": codiceTitolo,
                "NumeroCopia": numeroCopia,
                "CodiceEditoriale": codiceEditoriale
            }))
            const response = await fetch(url, {
                method: "POST",
                body: formData
            });
            if (response.ok){
                location.reload();
            }
            else{
                console.log(await response.text());
            }
        }catch(e){
            console.log(e.message);
        }
    }
}

async function getArticleData() {
    const url = './apis/vendor/api-getcopiesofbook-load.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const articoli = loadCopies(json);
        const main = document.querySelector("main > section:first-of-type");
        main.innerHTML = articoli;
    } catch (error) {
        console.log(error.message);
    }
}

getArticleData();