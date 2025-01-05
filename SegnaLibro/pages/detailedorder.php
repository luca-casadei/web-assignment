<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ".$__DIR__."index.php");
}
?>
<aside>
    <p>Prezzo: <strong><?php echo $tp["Prezzo"]?>€</strong></p>
    <button>Aggiungi al carrello</button>
</aside>
<section>
    <header>
        <h1><?php echo $tp["Titolo"]?></h1>
        <p><?php echo $tp["NomeAutore"]." ".$tp["CognomeAutore"]?></p>
        <p><?php echo $tp["NomeEditore"]?></p>
        <p><?php echo $tp["ISBN"]?></p>
    </header>

    <div>
        <input type="button" aria-label="Immagine precedente" />
        <figure>
            <img src="./images/book-placeholder.jpg" alt="Copertina del libro" />
        </figure>
        <input type="button" aria-label="Immagine successiva" />
    </div>

    <p><?php echo $tp["DescrizioneAnnuncio"]?></p>

    <footer>
        <p>Prezzo: <strong><?php echo $tp["Prezzo"]?>€</strong></p>
        <button>Aggiungi al carrello</button>
    </footer>
</section>