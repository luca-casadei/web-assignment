async function loadBooks(books) {
    var result = `
        <h1>Gestione libri</h1>
        <input type = "button" value = "Aggiungi libro" onClick=\'redirectToInsertBook()\' />
        `;
    for (const b of books) {
        const htmlGenres = await loadGenres(b);
        result += `
            <article> 
                <header>
                    <h2>${b["Titolo"]}</h2>
                    <input type="image" src="./images/pencil.png" alt="Edit book" onClick=\'expandBook(\"${b["EAN"]}\",\"${b["CodiceTitolo"]}\",\"${b["CodiceEditoriale"]}\",\"${b["CodiceRegGroup"]}\")\'/>
                </header>
                <p>
                    <ul>
                        <li>
                            <p>
                                Autore:
                            </p>
                            <p>
                                ${b["NomeAutore"]} ${b["CognomeAutore"]}
                            </p>
                        </li>
                        <li>
                            <p>
                                Anno:
                            </p>
                            <p>
                                ${b["DataPubblicazione"]}
                            </p>
                        </li>
                        <li>
                            <p>
                                Categoria:
                            </p>
                            <p>
                                ${b["NomeCategoria"]}
                            </p>
                        </li>
                        <li>
                            <p>
                                Generi:
                            </p>
                            <ul>
                                ${htmlGenres}
                            </ul>
                        </li>
                    </ul>
                </p>
                <footer>
                    <input type="button" value="Aggiungi copia"/>
                    <label for="gotocopies${b["EAN"]}-${b["CodiceTitolo"]}-${b["CodiceEditoriale"]}-${b["CodiceRegGroup"]}">Visualizza annunci</label> 
                    <input id="gotocopies${b["EAN"]}-${b["CodiceTitolo"]}-${b["CodiceEditoriale"]}-${b["CodiceRegGroup"]}" type="image" src="./images/list.png" alt="View announces" onclick="gotoRelatedAnnounces(\'${b["EAN"]}\',\'${b["CodiceTitolo"]}\',\'${b["CodiceEditoriale"]}\',\'${b["CodiceRegGroup"]}\')"/>
                </footer>
            </article>
            `;
    }
    return result;
}

async function gotoRelatedAnnounces(ean, codiceTitolo, codiceEditoriale, codiceRegGroup){
    const url = "./apis/vendor/api-getcopiesofbook.php";
    try{
        let formData = new FormData()
        formData.append("bofcopies", JSON.stringify({
            "EAN": ean,
            "CodiceTitolo": codiceTitolo,
            "CodiceRegGroup": codiceRegGroup,
            "CodiceEditoriale": codiceEditoriale
        }));
        const response = await fetch(url,{
            method: "POST",
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            window.location.href = "./copies_of_book_index.php"
        }
    } catch(error){
        console.log(error);
    }
}

async function loadGenres(book) {
    const url = "./apis/vendor/api-books-genres.php";
    try {
        let data = new FormData();
        data.append(
            "book",
            JSON.stringify({
                ean: book["EAN"],
                codiceeditoriale: book["CodiceEditoriale"],
                codicereggroup: book["CodiceRegGroup"],
                codicetitolo: book["CodiceTitolo"],
            })
        );
        const response = await fetch(url, {
            method: "POST",
            body: data,
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            const genres = await response.json();
            let htmlGenres = "";
            genres.forEach((genre) => {
                htmlGenres += `<li>${genre["Nome"]}</li>`;
            });
            return htmlGenres;
        }
    } catch (error) {
        console.log(error);
    }
}

async function getBookData() {
    const url = "./apis/vendor/api-books.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            const json = await response.json();
            const libri = await loadBooks(json);
            const main = document.querySelector("main");
            main.innerHTML = libri;
        }
    } catch (error) {
        console.log(error);
    }
}

async function expandBook(ean, codiceTitolo, codiceEditoriale, codiceRegGroup){
    const url = './apis/vendor/api-book-modify.php';
    try {
        const formData = new FormData();
        formData.append("expandedvendorbook", JSON.stringify({
            "EAN": ean,
            "CodiceEditoriale": codiceEditoriale,
            "CodiceRegGroup": codiceRegGroup,
            "CodiceTitolo": codiceTitolo
        }));
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            window.location.href = "./book_modify_index.php";
        }
    } catch (error) {
        console.log(error.message);
    }
}

function redirectToInsertBook(){
    window.location.href = "./book_insert_index.php";
}


getBookData();
