document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("main[data-book_insert] form");
    const authorSelect = document.getElementById('authorSelect');
    const customAuthorLi = document.querySelector('li[customAuthor]');
    const customAuthorInput = customAuthorLi.querySelector('input');
    const categorySelect = document.getElementById('categorySelect');


    customAuthorLi.style.display = 'none';

    form.addEventListener("submit", handleFormSubmit);
    authorSelect.addEventListener('change', handleAuthorSelectChange);

    async function handleFormSubmit(event) {
        const isbn = document.getElementById("book_isbn").value.trim();
        const genresCheckboxes = document.querySelectorAll('input[name="genres[]"]:checked');

        const parts = isbn.split("-");

        if (!isValidISBN(parts)) {
            alert("ISBN non valido! Assicurati che sia nel formato EAN-CodiceRegGroup-CodiceEditoriale-CodiceTitolo-CifraControllo");
            event.preventDefault();
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
            Descrizione: document.getElementById("description").value.trim(),
            DataPubblicazione: document.getElementById("date").value.trim(),
            Edizione: document.getElementById("edition").value.trim()
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
            Categoria: categorySelect.value
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
                body: formData
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const json = await response.json();
        } catch (error) {
            console.log(error.message);
        }
    }

    function isValidISBN(parts) {
        if (parts.length !== 5) return false;

        const [ean, regGroup, codEdit, codTitle, codCheck] = parts;
        return /^\d{3}$/.test(ean) && /^\d+$/.test(regGroup) && /^\d+$/.test(codEdit) && /^\d+$/.test(codTitle) && /^\d+$/.test(codCheck);
    }

    function handleAuthorSelectChange() {
        if (authorSelect.value === 'custom') {
            customAuthorLi.style.display = 'flex';
            customAuthorInput.focus();
        } else {
            customAuthorLi.style.display = 'none';
            customAuthorInput.value = '';
        }
    }
});
