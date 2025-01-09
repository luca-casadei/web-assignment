<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../../index.php");
}
?>
<h1>Modifica Libro</h1>

<form method="POST">
    <label for="book_title">Titolo</label>
    <input type="text" id="book_title" name="book_title" value="<?php echo $data["Titolo"]?>">

    <div>
        <label for="author">Autore</label>
        <label for="year">Anno</label>
    </div>
    <div>
        <input type="text" id="author" name="author" value="<?php echo $data["NomeAutore"]?> <?php echo $data["CognomeAutore"]?>">
        <input type="text" id="year" name="year" value="<?php echo $data["DataPubblicazione"]?>">
    </div>

    <label for="description">Descrizione</label>
    <textarea id="description" name="description"><?php echo $data["Descrizione"]?></textarea>

    <label for="category">Categoria</label>
    <select id="category" name="category">
        <option value="">Seleziona una categoria</option>
        <option value="romanzo">Romanzo</option>
        <option value="saggio">Saggio</option>
        <option value="fantascienza">Fantascienza</option>
    </select>

    <fieldset>
        <legend>Generi</legend>
        <div>
            <input type="checkbox" id="genre1" name="genres[]" value="genere1">
            <label for="genre1">Genere 1</label>
        </div>
        <div>
            <input type="checkbox" id="genre2" name="genres[]" value="genere2">
            <label for="genre2">Genere 2</label>
        </div>
        <div>
            <input type="checkbox" id="genre3" name="genres[]" value="genere3">
            <label for="genre3">Genere 3</label>
        </div>
    </fieldset>

    <input type="submit" value="Applica modifiche">
</form>
