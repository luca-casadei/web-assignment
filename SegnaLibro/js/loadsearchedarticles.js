function generateArticles(articoli, searchedTitle, priceRange, category) {
    let result = "<h1>Ricerca</h1>";

    for (let i = 0; i < articoli.length; i++) {
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
                `;
        if (articoli[i]["InCarrello"] === "INCART") {
            articolo += `<p>In carrello</p>`;
        }
        articolo += `
                    </footer>
                </div>
            </article>
            `;
        let st = false;
        let pt = false;
        let ct = false;
        if (searchedTitle != "") {
            if (
                articoli[i]["Titolo"]
                    .toLowerCase()
                    .includes(searchedTitle.toLowerCase()) ||
                articoli[i]["TitoloAnnuncio"]
                    .toLowerCase()
                    .includes(searchedTitle.toLowerCase())
            ) {
                st = true;
            }
        } else {
            st = true;
        }
        if (priceRange != "") {
            if (parseFloat(articoli[i]["Prezzo"]) <= parseFloat(priceRange)) {
                pt = true;
            }
        } else {
            pt = true;
        }
        if (category != "") {
            if (
                articoli[i]["NomeCategoria"].toLowerCase() ==
                category.toLowerCase()
            ) {
                ct = true;
            }
        } else {
            ct = true;
        }
        //Final check
        if (st && pt && ct) {
            result += articolo;
        }
    }
    return result;
}

async function updatePriceLabel() {
    const price = document.getElementById("pricerange").value;
    const priceLabel = document.querySelector("main > header > form p");
    priceLabel.innerHTML = "Prezzo <= €" + price;
    return price;
}

async function updateSearchTerms() {
    const price = await updatePriceLabel();
    const sv = document.getElementById("contentsearch").value;
    const category = document.getElementById("categoryselect").value;

    const json = await getArticlesJson();
    const articoli = generateArticles(json, sv, price, category);
    const main = document.querySelector("main > section");
    main.innerHTML = articoli;
}

async function getArticlesJson() {
    const url = "./apis/api-articles-ordered.php";
    const formData = new FormData();
    formData.append(
        "OrderMethod",
        document.getElementById("orderingselect").value
    );
    const response = await fetch(url, {
        method: "POST",
        body: formData,
    });
    if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    return json;
}

async function getArticleData() {
    const json = await getArticlesJson();
    const categories = await getCategories();
    const csele = document.getElementById("categoryselect");
    categories.forEach((c) => {
        csele.innerHTML += `<option id="${c["Nome"].toLowerCase()}">${
            c["Nome"]
        }</option>`;
    });

    const articoli = generateArticles(json, "", "", "");
    const main = document.querySelector("main > section");
    await updatePriceLabel();
    main.innerHTML = main.innerHTML + articoli;
}

async function getCategories() {
    const url = "./apis/vendor/api-categories.php";
    const response = await fetch(url);
    if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    return json;
}

async function expandArticles(
    ean,
    codiceEditoriale,
    codiceTitolo,
    codiceRegGroup,
    numeroCopia
) {
    const url = "./apis/api-detailed-article.php";
    try {
        console.log(codiceEditoriale);
        const formData = new FormData();
        formData.append(
            "expandedarticledata",
            JSON.stringify({
                EAN: ean,
                CodiceEditoriale: codiceEditoriale,
                CodiceTitolo: codiceTitolo,
                CodiceRegGroup: codiceRegGroup,
                NumeroCopia: numeroCopia,
            })
        );

        const response = await fetch(url, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            window.location.href = "./book_details_index.php";
        }
    } catch (error) {
        console.log(error.message);
    }
}

getArticleData();
