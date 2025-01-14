<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../../index.php");
}
?>

<section>
    <form method="POST">
    <h1>Inserisci nuovo libro</h1>
    <p>Compila i campi per aggiungere un nuovo libro al catalogo.</p>
    <ul>
        <li>
            <label for="book_isbn">ISBN</label>
            <input type="text" id="book_isbn" name="book_isbn" placeholder="978–12345–001001–000001–8" required>
        </li>
        <li>
            <label for="book_title">Titolo del libro</label>
            <input type="text" id="book_title" name="book_title" placeholder="Il nome della rosa..." required>
        <li>
            <label for="authorSelect">Autore</label>
            <select id="authorSelect" name="authorSelect" required>
                <option value="">Seleziona un autore</option>
            </select>
        </li>
        <li>
            <label for="customAuthor">Inserisci autore</label>
            <input type="text" id="customAuthor" placeholder="Nome e cognome...">
        </li>
        <li>
            <label for="editorName">Inserisci editore</label>
            <input type="text" id="editorName" placeholder="Editore"/>
        </li>
        </li>
        <li>
            <label for="book_publish_date">Anno</label>
            <input type="date" id="book_publish_date" name="book_publish_date" required>
        </li>
        <li>
            <label for="book_desription">Descrizione</label>
            <textarea id="book_desription" name="book_desription" placeholder="Scrivi qui la trama o qualche nota..."></textarea>
        </li>
        <li>
            <label for="book_edition">Edizione</label>
            <input type="number" id="book_edition" name="book_edition" placeholder="1" required>
        </li>
        <li>
            <label for="categorySelect">Categoria</label>
            <select id="categorySelect" name="categorySelect" required>
                <option value="">Seleziona una categoria</option>
            </select>
        </li>
        <li>
            <label>Generi</label>
            <fieldset data-genres-container><div data-js-genres></div></fieldset>
        </li>
    </ul>
    </form>
</section>

<section>
    <a href="./index.php">Aggiungi libro</a>
</section>