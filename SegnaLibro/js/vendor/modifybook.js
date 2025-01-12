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
