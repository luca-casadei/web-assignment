<?php
if (!defined('DIRECT_ACCESS')){
    header("Location: ".$__DIR__."index.php");
}
?>
<section>
    <header>
        <h2><?php echo $tp["Titolo"]?></h2>
        <ul>
            <li><?php echo $tp["NomeAutore"]." ".$tp["CognomeAutore"]?></li>
            <li><?php echo $tp["NomeEditore"]?></li>
            <li><span><?php echo $tp["ISBN"]?></span></li>
        </ul>
    </header> 
    <footer></footer> 
</section>