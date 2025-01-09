<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../index.php");
}
?>
<div>
    <p>Prezzo: <strong><?php echo $tp["Prezzo"]?>€</strong></p>
    <input type="button" aria-label="Aggiungi al carrello" 
    onclick='insertArticleInTheCart()' 
    value="Aggiungi al carrello" />
    </div>
<section>
    <header>
        <h1><?php echo $data["Titolo"]?></h1>
        <p><?php echo $data["NomeAutore"]." ".$data["CognomeAutore"]?></p>
        <p><?php echo $data["NomeEditore"]?></p>
        <p><?php echo $data["ISBN"]?></p>
    </header>

    <div>
        <input type="button" aria-label="Immagine precedente" onclick="prevImage()" />
        <div></div>
        <input type="button" aria-label="Immagine successiva" onclick="nextImage()" />
    </div>

    <p><?php echo $data["DescrizioneAnnuncio"]?></p>

    <footer>
        <p>Prezzo: <strong><?php echo $data["Prezzo"]?>€</strong></p>
        <input type="button" aria-label="Aggiungi al carrello" 
        onclick='insertArticleInTheCart()' 
        value="Aggiungi al carrello" />
    </footer>
</section>