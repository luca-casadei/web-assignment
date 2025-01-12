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
            const categorySelect = document.querySelector("#categorySelect");
            categorySelect.insertAdjacentHTML("beforeend", categoriesHtml);
            removeDuplicateOptions(categorySelect);
        }
    } catch (error) {
        console.log(error.message);
    }
}

function removeDuplicateOptions(selectElement) {
    const seen = new Set();
    Array.from(selectElement.options).forEach(option => {
        if (seen.has(option.value)) {
            option.remove();
        } else {
            seen.add(option.value);
        }
    });
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

async function updateGenres() {
    const categorySelect = document.querySelector("#categorySelect");
    const genresFieldset = document.querySelector("fieldset[data-genres-container]");
    const selectedCategoryId = categorySelect.value;
    if (selectedCategoryId) {
        try {
            const genres = await fetchCategoryGenres(selectedCategoryId);
            genresFieldset.innerHTML = loadGenresCheckboxes(genres);
        } catch (error) {
            console.log(error.message);
        }
    } else {
        genresFieldset.innerHTML = "";
    }
}

document.addEventListener("DOMContentLoaded", updateGenres);
document.querySelector("#categorySelect").addEventListener("change", updateGenres);
