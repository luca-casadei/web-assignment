document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("main[data-add_copy] form");


    form.addEventListener("submit", handleFormSubmit);
    
    async function handleFormSubmit(event) {
        event.preventDefault();
        
        const copyData = {
            "Titolo": document.getElementById("article_title").value.trim(),
            "Prezzo": document.getElementById("price").value.trim(),
            "Descrizione": document.getElementById("description").value.trim(),
            "Condizione": document.getElementById("conditionSelect").value.trim(),
        };

        console.log("Immagine selezionata", copyData["Immagine"]);

        const data = new FormData();
        data.append("newCopy", JSON.stringify(copyData));

        const fileInput = document.getElementById("imgarticle");
        if(fileInput.isDefaultNamespace.length > 0) {
            console.log("Immagine selezionata", fileInput.files[0]);
            data.append("imgarticle", fileInput.files[0]);
        }

        const url = "./apis/vendor/api-addcopy.php";
        try {
            const response = await fetch(url, {
                method: "POST",
                body: data
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const json = await response.text();
            console.log("JSON", json);
        } catch (error) {
            console.log(error.message);
        }
    }
})