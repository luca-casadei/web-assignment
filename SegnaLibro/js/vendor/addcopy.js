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

        const data = new FormData();
        data.append("newCopy", JSON.stringify(copyData));

        const fileInput = document.getElementById("imgarticle");

        for (let i = 0; i < fileInput.files.length; i++) {
            data.append(`imgarticle${i}`, fileInput.files[i]);
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
        } catch (error) {
            console.log(error.message);
        }
    }
})