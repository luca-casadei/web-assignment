document.addEventListener('DOMContentLoaded', function() {
    const authorSelect = document.getElementById('authorSelect');
    const customAuthorInput = document.querySelector('[placeholder="Nome e cognome..."]');
    const customAuthorLi = customAuthorInput.parentElement;

    customAuthorLi.style.display = 'none';

    authorSelect.addEventListener('change', handleAuthorSelectChange);

    function handleAuthorSelectChange() {
        if (authorSelect.value === 'custom') {
            customAuthorLi.style.display = 'flex';
            customAuthorInput.focus();
        } else {
            customAuthorLi.style.display = 'none';
            customAuthorInput.value = '';
        }
    }

    const form = document.querySelector('form');
    if (form) {
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            updateBook();
        });
    }
});

async function updateBook() {
    const isbnInput = document.getElementById("book_isbn").value.trim();
    const parts = isbnInput.split("-");
    const [ean, regGroup, codEdit, codTitle, codCheck] = parts;

    const bookData = {
        EAN: ean,
        CodiceRegGroup: regGroup,
        CodiceEditoriale: codEdit,
        CodiceTitolo: codTitle,
        CifraControllo: codCheck,
        Titolo: document.getElementById("book_title").value.trim(),
        Descrizione: document.getElementById("book_description").value.trim(),
        DataPubblicazione: document.getElementById("book_publish_date").value.trim(),
        Edizione: document.getElementById("book_edition").value.trim()
    };

    let authorName, authorLastName;
    if (document.getElementById('authorSelect').value === 'custom') {
        [authorName, ...authorLastName] = customAuthorInput.value.trim().split(' ');
    } else {
        [authorName, ...authorLastName] = document.getElementById('authorSelect').options[document.getElementById('authorSelect').selectedIndex].text.trim().split(' ');
    }
    authorLastName = authorLastName.join(' ');
    const authorData = {
        Nome: authorName,
        Cognome: authorLastName
    };

    const categorySelect = document.getElementById('categorySelect');
    const categoryData = {
        Nome: categorySelect.options[categorySelect.selectedIndex].text.trim()
    };

    const genresCheckboxes = document.querySelectorAll('input[name="genres[]"]:checked');
    const genresData = Array.from(genresCheckboxes).map(checkbox => checkbox.value);

    const formData = new FormData();
    formData.append("book", JSON.stringify(bookData));
    formData.append("author", JSON.stringify(authorData));
    formData.append("category", JSON.stringify(categoryData));
    formData.append("genres", JSON.stringify(genresData));

    const url = './apis/vendor/api-book-modify.php';
    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        redirectToCompleteOrder();
    } catch (error) {
        console.log(error.message);
    }
}
