<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../../index.php");
}
?>

<div>
    <input type="submit" value="Applica modifiche" form="modifyBookForm">
</div>

<section>
<h1>Modifica Libro</h1>

<form id="modifyBookForm">
    <ul>
        <li>
            <label for="book_isbn">ISBN</label>
            <input type="text" id="book_isbn" name="book_isbn" placeholder="978–12345–001001–000001–8" value="<?php echo $data["EAN"] ?>-<?php echo $data["CodiceRegGroup"] ?>-<?php echo $data["CodiceEditoriale"] ?>-<?php echo $data["CodiceTitolo"] ?>-<?php echo $data["CifraControllo"] ?>" disabled>
        </li>
        <li>
            <label for="book_title">Titolo del libro</label>
            <input type="text" id="book_title" name="book_title" placeholder="Il nome della rosa..." value="<?php echo $data["Titolo"] ?>" required>
        <li>
            <label for="authorSelect">Autore</label>
            <select id="authorSelect" name="authorSelect" required>
                <option value="">Seleziona un autore</option>
                <?php if (isset($data["CodiceAutore"])) { ?>
                    <option value="<?php echo $data["CodiceAutore"]; ?>" selected>
                        <?php echo $data["NomeAutore"]; ?> <?php echo $data["CognomeAutore"]; ?>
                    </option>
                <?php } ?>
            </select>
        </li>
        <li customAuthor>
            <label for="customAuthor">Inserisci autore</label>
            <input type="text" id="customAuthor" placeholder="Nome e cognome...">
        </li>
        </li>
        <li>
            <label for="book_publish_date">Anno</label>
            <input type="date" id="book_publish_date" name="book_publish_date" placeholder="1980" value="<?php echo $data["DataPubblicazione"]; ?>" required>
        </li>
        <li>
            <label for="book_description">Descrizione</label>
            <textarea id="book_description" name="book_description" placeholder="Scrivi qui la trama o qualche nota..."><?php echo $data["Descrizione"]; ?></textarea>
        </li>
        <li>
            <label for="book_edition">Edizione</label>
            <input type="number" id="book_edition" name="book_edition" placeholder="1" value="<?php echo $data["Edizione"]; ?>" required>
        </li>
        <li>
            <label for="categorySelect">Categoria</label>
            <select id="categorySelect" name="categorySelect" required>
                <option value="">Seleziona una categoria</option>
                <?php if (isset($data["CodiceCategoria"])) { ?>
                    <option value="<?php echo $data["CodiceCategoria"]; ?>" selected>
                        <?php echo $data["NomeCategoria"]; ?>
                    </option>
                <?php } ?>
            </select>
        </li>
        <li>
            <label>Generi</label>
            <fieldset data-genres-container>
                <div data-preselected-genres>
                    <?php foreach ($genres as $genre) { ?>
                        <label>
                            <input type="checkbox" name="genres[]" value="<?php echo $genre["Codice"]; ?>" checked>
                            <?php echo $genre["Nome"]; ?>
                        </label><br>
                    <?php } ?>
                </div>
                <div data-js-genres></div>
            </fieldset>
        </li>
    </ul>

    <input type="submit" value="Applica modifiche">
</form>
</section>