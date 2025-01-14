document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("main[data-book_insert] form");
    const authorSelect = document.getElementById('authorSelect');
    const customAuthorInput = document.querySelector('[placeholder="Nome e cognome..."]');
    const customAuthorLi = customAuthorInput.parentElement;
    const authorSelectLi = authorSelect.parentElement;
    const categorySelect = document.getElementById('categorySelect');

    customAuthorLi.remove();

    form.addEventListener("submit", handleFormSubmit);
    authorSelect.addEventListener('change', handleAuthorSelectChange);

    function handleAuthorSelectChange() {
        if (authorSelect.value === 'custom') {
            authorSelectLi.insertAdjacentElement('afterend', customAuthorLi);
            customAuthorInput.focus();
        } else {
            customAuthorLi.remove();
            customAuthorInput.value = '';
        }
    }

    async function handleFormSubmit(event) {
        event.preventDefault();
        const isbn = document.getElementById("book_isbn").value.trim();
        const genresCheckboxes = document.querySelectorAll('input[name="genres[]"]:checked');

        const parts = isbn.split("-");

        if (!isValidISBN(parts)) {
            alert("ISBN non valido! Assicurati che sia nel formato EAN-CodiceRegGroup-CodiceEditoriale-CodiceTitolo-CifraControllo");
            return;
        }

        const [ean, regGroup, codEdit, codTitle, codCheck] = parts;
        const bookData = {
            CodiceEditoriale: codEdit,
            CodiceRegGroup: regGroup,
            EAN: ean,
            CodiceTitolo: codTitle,
            CifraControllo: codCheck,
            Titolo: document.getElementById("book_title").value.trim(),
            Descrizione: document.getElementById("book_desription").value.trim(),
            DataPubblicazione: document.getElementById("book_publish_date").value.trim(),
            Edizione: document.getElementById("book_edition").value.trim(),
            NomeEditore: document.getElementById("editorName").value.trim()
        };

        let authorName, authorLastName;
        if (authorSelect.value === 'custom') {
            [authorName, ...authorLastName] = customAuthorInput.value.trim().split(' ');
        } else {
            [authorName, ...authorLastName] = authorSelect.options[authorSelect.selectedIndex].text.trim().split(' ');
        }
        authorLastName = authorLastName.join(' ');
        const authorData = {
            Nome: authorName,
            Cognome: authorLastName
        };

        const categoryData = {
            Nome: categorySelect.options[categorySelect.selectedIndex].text.trim()
        };

        const genresData = Array.from(genresCheckboxes).map(checkbox => checkbox.value);

        const data = new FormData();
        data.append("book", JSON.stringify(bookData));
        data.append("author", JSON.stringify(authorData));
        data.append("category", JSON.stringify(categoryData));
        data.append("genres", JSON.stringify(genresData));

        const url = "./apis/vendor/api-book-insert.php";
        try {
            const response = await fetch(url, {
                method: "POST",
                body: data
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const json = await response.json();
            if (json["book"] == true) {
                    alert("Libro inserito con successo")
                    window.location.href = "./index.php";
            }
            else{
                console.log(json);
            }
        } catch (error) {
            console.log(error.message);
        }
    }

    function isValidISBN(parts) {
        if (parts.length !== 5) return false;

        const [ean, regGroup, codEdit, codTitle, codCheck] = parts;

        const isEANValid = ean.length === 3;
        const isRegGroupValid = regGroup.length > 0;
        const isCodEditValid = codEdit.length > 0;
        const isCodTitleValid = codTitle.length > 0;
        const isCodCheckValid = codCheck.length > 0;

        return isEANValid && isRegGroupValid && isCodEditValid && isCodTitleValid && isCodCheckValid;
    }
});
