async function getBookImages() {
    const url = './apis/api-detailed-article.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log("json", json);
    } catch (error) {
        console.log(error.message);
    }
}

getBookImages();