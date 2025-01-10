<?php
if (!defined('DIRECT_ACCESS')) {
    header("Location: ../index.php");
}
?>
<aside>
    <p>Prezzo: <strong><?php echo $data["Prezzo"] ?>€</strong></p>
    <input type="button" aria-label="Aggiungi al carrello"
        onclick='insertArticleInTheCart()'
        value="Aggiungi al carrello" />
</aside>
<section>
    <header>
        <h1><?php echo $data["Titolo"] ?></h1>
        <p><?php echo $data["NomeAutore"] . " " . $data["CognomeAutore"] ?></p>
        <p><?php echo $data["NomeEditore"] ?></p>
        <p><?php echo $data["ISBN"] ?></p>
        <p>Condizione: <?php echo $data["NomeCondizione"]?></p>
    </header>

    <div>
        <input type="button" aria-label="Immagine precedente" onclick="prevImage()" />
        <div></div>
        <input type="button" aria-label="Immagine successiva" onclick="nextImage()" />
    </div>

    <p><?php echo $data["DescrizioneAnnuncio"] ?></p>

    <footer>
        <p>Prezzo: <strong><?php echo $data["Prezzo"] ?>€</strong></p>
        <input type="button" aria-label="Aggiungi al carrello"
            onclick='insertArticleInTheCart()'
            value="Aggiungi al carrello" />
    </footer>
</section>