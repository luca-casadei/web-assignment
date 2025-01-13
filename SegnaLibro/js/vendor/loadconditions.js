function loadConditions(categoriesArray) {
    let options = "";
    categoriesArray.forEach(condition => {
        options += `<option value="${condition.Codice}">${condition.Nome}</option>`;
    });
    return options;
}

async function getConditionsData() {
    const url = "./apis/vendor/api-conditions.php"; 
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            const json = await response.json();
            const conditionsHtml = loadConditions(json);
            const conditionSelect = document.querySelector("#conditionSelect");
            conditionSelect.insertAdjacentHTML("beforeend", conditionsHtml);
        }
    } catch (error) {
        console.log(error.message);
    }
}

getConditionsData();