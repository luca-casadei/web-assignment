<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../../index.php");
}
?>
<div>
    <a href="./index.php">Aggiungi libro</a>
</div>

<section>
    <form method="POST">
    <h1>Inserisci nuovo libro</h1>
    <p>Compila i campi per aggiungere un nuovo libro al catalogo.</p>
    <ul>
        <li>
            <label for="book_isbn">ISBN</label>
            <input type="text" id="book_isbn" name="book_isbn" placeholder="978–12345–001001–000001–8">
        </li>
        <li>
            <label for="book_title">Titolo del libro</label>
            <input type="text" id="book_title" name="book_title" placeholder="Il nome della rosa...">
        <li>
            <label for="authorSelect">Autore</label>
            <select id="authorSelect" name="authorSelect">
                <option value="">Seleziona un autore</option>
            </select>
        </li>
        <li customAuthor>
            <label for="customAuthor">Inserisci autore</label>
            <input type="text" id="customAuthor" placeholder="Nome e cognome...">
        </li>
        </li>
        <li>
            <label for="publishDate">Anno</label>
            <input type="date" id="publishDate" name="publishDate" placeholder="1980">
        </li>
        <li>
            <label for="description">Descrizione</label>
            <textarea id="description" name="description" placeholder="Scrivi qui la trama o qualche nota..."></textarea>
        </li>
        <li>
            <label for="edition">Edizione</label>
            <input type="number" id="edition" name="edition" placeholder="1">
        </li>
        <li>
            <label for="category">Categoria</label>
            <select id="category" name="category">
                <option value="">Seleziona una categoria</option>
            </select>
        </li>
        <li>
            <label>Generi</label>
            <fieldset data-genres-container></fieldset>
        </li>
    </ul>
    <input type="submit" value="Aggiungi Libro">
    </form>
</section>