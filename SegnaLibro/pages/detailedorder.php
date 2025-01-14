<?php
if (!defined('DIRECT_ACCESS')) {
    header("Location: ../index.php");
}
?>

<section>
    <header>
        <h1><?php echo $data["Titolo"] ?></h1>
        <p><?php echo $data["NomeAutore"] . " " . $data["CognomeAutore"] ?></p>
        <p><?php echo $data["NomeEditore"] ?></p>
        <p><?php echo $data["ISBN"] ?></p>
        <p>Condizione: <?php echo $data["NomeCondizione"] ?></p>
    </header>
    <?php if (isset($data["NomeImmagine"])) { ?>
        <div>
            <label for="nextimg">next</label>
            <input id="nextimg" type="image" src="./images/arrow_left.png" alt="Next image" aria-label="Immagine precedente" onclick="prevImage()" />
            <div></div>
            <label for="previmg">prev</label>
            <input id="previmg" type="image" src="./images/arrow_right.png" alt="Previous image" aria-label="Immagine successiva" onclick="nextImage()" />
        </div>
    <?php } ?>
    <p><?php echo $data["DescrizioneAnnuncio"] ?></p>
    <footer>
        <p>Prezzo: <span><?php echo $data["Prezzo"] ?>€</span></p>
        <input type="button" aria-label="Aggiungi al carrello"
            onclick='insertArticleInTheCart()'
            value="Aggiungi al carrello" />
    </footer>
</section>