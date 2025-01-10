<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../../index.php");
}
?>

<div>
    <input type="submit" value="Applica modifiche">
</div>

<section>
<h1>Modifica Libro</h1>

<form method="POST">
    <ul>
        <li>
            <label for="book_title">Titolo</label>
            <input type="text" id="book_title" name="book_title" value="<?php echo $data["Titolo"]?>">
        </li>
        <li>
            <label for="author">Autore</label>
            <input type="text" id="author" name="author" value="<?php echo $data["NomeAutore"]?> <?php echo $data["CognomeAutore"]?>">
        </li>
        <li>
            <label for="year">Anno</label>
            <input type="text" id="year" name="year" value="<?php echo $data["DataPubblicazione"]?>">
        </li>
        <li>
            <label for="description">Descrizione</label>
            <textarea id="description" name="description"><?php echo $data["Descrizione"]?></textarea>
        </li>
        <li>
            <label for="category">Categoria</label>
            <select id="category" name="category">
                <option value="">Seleziona una categoria</option>
                <option value="romanzo">Romanzo</option>
                <option value="saggio">Saggio</option>
                <option value="fantascienza">Fantascienza</option>
            </select>
        </li>
    </ul>

    <fieldset>
        <legend>Generi</legend>
        <ul>
            <li>
                <label for="genre1">Genere 1</label>
                <input type="checkbox" id="genre1" name="genres[]" value="genere1">
            </li>
            <li>
                <label for="genre2">Genere 2</label>
                <input type="checkbox" id="genre2" name="genres[]" value="genere2">
            </li>
            <li>
                <label for="genre3">Genere 3</label>
                <input type="checkbox" id="genre3" name="genres[]" value="genere3">
            </li>
        </ul>
    </fieldset>

    <input type="submit" value="Applica modifiche">
</form>
</section>