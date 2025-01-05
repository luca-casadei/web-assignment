function generateArticles(articoli){
    let result = "";

    for(let i=0; i < articoli.length; i++){
        let articolo = `
        <article onClick=\'expandArticles(${JSON.stringify(articoli[i])})\'>
            <header>
            <figure>
                <img src="${articoli[i]["NomeImmagine"]}" alt="" />
            </figure>
            <h2>${articoli[i]["TitoloAnnuncio"]}</h2>
            <p>${articoli[i]["NomeAutore"]} ${articoli[i]["CognomeAutore"]}</p>
            <p>${articoli[i]["NomeCategoria"]}</p>
            </header>
            <p>
            ${articoli[i]["DescrizioneAnnuncio"]}
            </p>
            <footer>
            <p>${articoli[i]["Prezzo"]}</p>
            <p>Condizione:<span>${articoli[i]["NomeCondizione"]}</span></p>
            </footer>
        </article>
        `;
        result += articolo;
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

async function expandArticles(art){
    const url = './apis/api-detailed-article.php';
    try {
        const response = await fetch(url, {
            method: "POST",
            body: JSON.stringify(art)
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