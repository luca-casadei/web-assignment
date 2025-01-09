<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ../index.php");
}
?>
<div>
    <p>Prezzo: <strong><?php echo $tp["Prezzo"]?>€</strong></p>
    <input type="button" aria-label="Aggiungi al carrello" 
    onclick='insertArticleInTheCart("<?php echo $tp["NumeroCopia"]?>", 
        "<?php echo $tp["EAN"]?>", 
        "<?php echo $tp["CodiceRegGroup"]?>", 
        "<?php echo $tp["CodiceEditoriale"]?>", 
        "<?php echo $tp["CodiceTitolo"]?>")' 
    value="Aggiungi al carrello" />
    </div>
<section>
    <header>
        <h1><?php echo $tp["Titolo"]?></h1>
        <p><?php echo $tp["NomeAutore"]." ".$tp["CognomeAutore"]?></p>
        <p><?php echo $tp["NomeEditore"]?></p>
        <p><?php echo $tp["ISBN"]?></p>
    </header>

    <div>
        <input type="button" aria-label="Immagine precedente" onclick="prevImage()" />
        <div></div>
        <input type="button" aria-label="Immagine successiva" onclick="nextImage()" />
    </div>

    <p><?php echo $tp["DescrizioneAnnuncio"]?></p>

    <footer>
        <p>Prezzo: <strong><?php echo $tp["Prezzo"]?>€</strong></p>
        <input type="button" aria-label="Aggiungi al carrello" 
        onclick='insertArticleInTheCart("<?php echo $tp["NumeroCopia"]?>", 
            "<?php echo $tp["EAN"]?>", 
            "<?php echo $tp["CodiceRegGroup"]?>", 
            "<?php echo $tp["CodiceEditoriale"]?>", 
            "<?php echo $tp["CodiceTitolo"]?>")' 
        value="Aggiungi al carrello" />
    </footer>
</section>