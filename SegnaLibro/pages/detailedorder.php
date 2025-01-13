<?php
if (!defined('DIRECT_ACCESS')) {
    header("Location: ../index.php");
}
?>
<div>
    <p>Prezzo: <strong><?php echo $data["Prezzo"]?>€</strong></p>
    <input type="button" aria-label="Aggiungi al carrello" 
    onclick='insertArticleInTheCart()' 
    value="Aggiungi al carrello" />
    </div>
<section>
    <header>
        <h1><?php echo $data["Titolo"] ?></h1>
        <p><?php echo $data["NomeAutore"] . " " . $data["CognomeAutore"] ?></p>
        <p><?php echo $data["NomeEditore"] ?></p>
        <p><?php echo $data["ISBN"] ?></p>
        <p>Condizione: <?php echo $data["NomeCondizione"]?></p>
    </header>

    <div>
        <label for="nextimg">next</label>
        <input id="nextimg" type="image" src="./images/arrow_left.png" alt="Next image" aria-label="Immagine precedente" onclick="prevImage()" />
        <div></div>
        <label for="previmg">prev</label>
        <input id="previmg" type="image" src="./images/arrow_right.png" alt="Previous image" aria-label="Immagine successiva" onclick="nextImage()" />
    </div>

    <p><?php echo $data["DescrizioneAnnuncio"] ?></p>

    <footer>
        <p>Prezzo: <strong><?php echo $data["Prezzo"] ?>€</strong></p>
        <input type="button" aria-label="Aggiungi al carrello"
            onclick='insertArticleInTheCart()'
            value="Aggiungi al carrello" />
    </footer>
</section>