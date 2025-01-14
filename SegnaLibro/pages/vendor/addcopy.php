<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../../index.php");
}
?>

<section>
<h1>Aggiungi Copia</h1>

<form id="addCopyForm" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="article_title">Titolo annuncio</label>
            <input type="text" id="article_title" name="article_title" placeholder="Il nome della rosa..." required>
        </li>
        <li>
            <label for="price">Prezzo</label>
            <input type="text" id="price" name="price" placeholder="10.99" required>
        </li>
        <li>
            <label for="conditionSelect">Condizione</label>
            <select id="conditionSelect" name="conditionSelect" required>
                <option value="">Seleziona una condizione</option>
            </select>
        </li>
        <li>
            <label for="description">Descrizione annuncio</label>
            <textarea id="description" name="description" placeholder="Descrizione annuncio..."></textarea>
        </li>
        <li>
            <label for="imgarticle">Immagine Articolo</label>
            <input type="file" name="imgarticle" id="imgarticle" accept=".png,.jpg,.jpeg" multiple />
        </li>
    </ul>
    <div>
        <input type="submit" value="Aggiungi copia">
    </div>
</form>
</section>