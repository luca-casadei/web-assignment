function loadCategories(categoriesArray) {
    let options = "";
    categoriesArray.forEach(category => {
        options += `<option value="${category.Codice}">${category.Nome}</option>`;
    });
    return options;
}

async function getCategoriesData() {
    const url = "./apis/vendor/api-categories.php"; 
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            const json = await response.json();
            const categoriesHtml = loadCategories(json);
            const categorySelect = document.querySelector("#category");
            categorySelect.insertAdjacentHTML("beforeend", categoriesHtml);
        }
    } catch (error) {
        console.log(error.message);
    }
}

getCategoriesData();


function loadGenresCheckboxes(genresArray) {
    let checkboxes = "";
    genresArray.forEach((genre) => {
        checkboxes += `
      <label>
        <input type="checkbox" name="genres[]" value="${genre.Codice}">
        ${genre.Nome}
      </label><br>
    `;
    });
    return checkboxes;
}

async function fetchCategoryGenres(categoryId) {
    const url = `./apis/vendor/api-category-genres.php`;
    const data = new FormData();
    data.append('category', categoryId);

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const genresData = await response.json();
        return genresData;
    } catch (error) {
        console.log(error.message);
        return [];
    }
}

document.querySelector("#category").addEventListener("change", async (event) => {
    const selectedCategoryId = event.target.value;
    if (selectedCategoryId) {
        const genres = await fetchCategoryGenres(selectedCategoryId);
        document.querySelector("fieldset[data-genres-container]").innerHTML = loadGenresCheckboxes(genres);
    } else {
        document.querySelector("fieldset[data-genres-container]").innerHTML = "";
    }
});