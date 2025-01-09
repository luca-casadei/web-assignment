<?php
    require './bootstrap.php';
    if (!isset($_SESSION["expandedarticledata"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - Dettagli libro";
    $tp["identification"] = "book_details";
    $tp["content"] = './pages/detailedorder.php';
    
    $data = json_decode($_SESSION["expandedarticledata"], true);
    
    $data = $dbh->getAnnounce($data["EAN"], $data["CodiceRegGroup"], $data["CodiceEditoriale"], $data["CodiceTitolo"], $data["NumeroCopia"]);
    $data["ISBN"] = $data["EAN"]."-".$data["CodiceRegGroup"]."-".$data["CodiceEditoriale"]."-".$data["CodiceTitolo"]."-".$data["NumeroCopia"];

    array_push($tp["js"], "./js/book_details.js");
    require './template/base.php';
?>