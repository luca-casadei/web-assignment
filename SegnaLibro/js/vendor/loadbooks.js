async function loadBooks(books) {
    var result = "<h1>Gestione libri</h1>";
    for (const b of books) {
        const htmlGenres = await loadGenres(b);
        result += `
            <article onClick=\'expandBook(${JSON.stringify(b)})\'> 
                <header>
                    <h2>${b["Titolo"]}</h2>
                    <input type="button"/>
                </header>
                <hr>
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
                <hr>
                <footer>
                    <input type="button" value="Aggiungi copia"/>
                    <input type="button"/>
                </footer>
            </article>
            `;
    }
    return result;
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

async function expandBook(book){
    const url = './apis/api-book-modify.php';
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

getBookData();
