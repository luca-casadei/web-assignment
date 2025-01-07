let currentIndex = 0;

async function getBookImages() {
    const url = './apis/api-detailed-article-images.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const images = await response.json();
        console.log(images);

        const carouselContainer = document.querySelector('main[data-book_details] div > div');

        images.forEach((image, index) => {
            const imgElement = document.createElement('img');
            imgElement.src = "./images/upload/" + image.Percorso;
            imgElement.alt = "Copertina del libro";
            
            console.log(carouselContainer);

            carouselContainer.appendChild(imgElement);
        });
        updateCarousel();
    } catch (error) {
        console.log(error.message);
    }
}

function updateCarousel() {
    const images = document.querySelectorAll('main[data-book_details] div > div img');
    images.forEach((img, index) => {
        img.style.display = "none";
    });
    images[currentIndex].style.display = "flex";
}

function prevImage() {
    const images = document.querySelectorAll('main[data-book_details] div > div img');
    const totalImages = images.length;
    currentIndex = (currentIndex === 0) ? totalImages - 1 : currentIndex - 1;
    updateCarousel();
    images[currentIndex].style.display = "flex";
}

function nextImage() {
    const images = document.querySelectorAll('main[data-book_details] div > div img');
    const totalImages = images.length;
    currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
    updateCarousel();
    images[currentIndex].style.display = "flex";
}

async function insertArticleInTheCart(numero_copia, ean, codice_reg_group, codice_editoriale, codice_titolo) {
    const url = './apis/api-cart.php';
    const data = new FormData();
    data.append('numero_copia', numero_copia);
    data.append('ean', ean);
    data.append('codice_reg_group', codice_reg_group);
    data.append('codice_editoriale', codice_editoriale);
    data.append('codice_titolo', codice_titolo);
    data.append('action', 'add');

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        if (json.status === "success") {
            alert("Articolo inserito correttamente nel carrello");
        }
    } catch (error) {
        console.log(error.message);
    }
}

getBookImages();
