document.addEventListener('DOMContentLoaded', function() {
    const authorSelect = document.getElementById('authorSelect');
    const customAuthorLi = document.querySelector('li[customAuthor]');
    const customAuthorInput = customAuthorLi.querySelector('input');

    customAuthorLi.style.display = 'none';

    authorSelect.addEventListener('change', handleAuthorSelectChange);

    function handleAuthorSelectChange() {
        if (authorSelect.value === 'custom') {
            customAuthorLi.style.display = 'flex';
            customAuthorInput.focus();
        } else {
            customAuthorLi.style.display = 'none';
            customAuthorInput.value = '';
        }
    }
});

function attachPreselectedListener() {
    const preselectedContainer = document.querySelector("div[data-preselected-genres]");
    const jsGenresContainer = document.querySelector("div[data-js-genres]");
    const preselectedCheckboxes = preselectedContainer.querySelectorAll("input[type='checkbox']");

    preselectedCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            if (!this.checked) {
                const label = this.closest("label");
                if (label) {
                    label.remove();
                    jsGenresContainer.insertAdjacentElement("beforeend", label);
                    sortContainerByCheckboxValue(jsGenresContainer);
                    if (!preselectedContainer.hasChildNodes() || preselectedContainer.innerHTML.trim() === "") {
                        preselectedContainer.remove();
                    }
                }
            }
        });
    });
}

function sortContainerByCheckboxValue(container) {
    const labelsArray = Array.from(container.querySelectorAll("label"));
    labelsArray.sort((a, b) => {
        const valA = a.querySelector("input[type='checkbox']").value;
        const valB = b.querySelector("input[type='checkbox']").value;
        const numA = parseFloat(valA);
        const numB = parseFloat(valB);
        if (!isNaN(numA) && !isNaN(numB)) {
            return numA - numB;
        } else {
            return valA.localeCompare(valB);
        }
    });
    container.innerHTML = "";
    labelsArray.forEach(label => {
        container.appendChild(label);
        container.insertAdjacentHTML("beforeend", "<br>");
    });
}

document.addEventListener("DOMContentLoaded", attachPreselectedListener);


