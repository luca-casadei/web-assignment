document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("main[data-add_copy] form");


    form.addEventListener("submit", handleFormSubmit);
    
    async function handleFormSubmit(event) {
        event.preventDefault();
        if(confirm("Sei sicuro di voler creare un annuncio per questo libro?")){
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
                const text = await response.text();
                if (text === 'SUCCESS'){
                    alert("Annuncio e copia creati con successo");
                    window.location.href = "./index.php";
                }
            } catch (error) {
                console.log(error.message);
            }
        }
    }
})