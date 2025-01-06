async function getBookImages() {
    const url = './apis/api-detailed-article-images.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        else{
            response.json().then(r => {
                console.log(r);
            })
        }
    } catch (error) {
        console.log(error.message);
    }
}

getBookImages();