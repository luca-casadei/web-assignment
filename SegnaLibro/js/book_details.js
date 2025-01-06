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
            imgElement.style.transform = `translateX(${index * 100}%)`;
            
            console.log(carouselContainer);

            carouselContainer.appendChild(imgElement);
        });
    } catch (error) {
        console.log(error.message);
    }
}

function updateCarousel() {
    const images = document.querySelectorAll('main[data-book_details] div > div img');
    images.forEach((img, index) => {
        img.style.transform = `translateX(${(index - currentIndex) * 100}%)`;
    });
}

function prevImage() {
    const totalImages = document.querySelectorAll('main[data-book_details] div > div img').length;
    currentIndex = (currentIndex === 0) ? totalImages - 1 : currentIndex - 1;
    updateCarousel();
}

function nextImage() {
    const totalImages = document.querySelectorAll('main[data-book_details] div > div img').length;
    currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
    updateCarousel();
}

getBookImages();
