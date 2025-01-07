<?php
    require './bootstrap.php';
    if (!isset($_SESSION["expandedarticledata"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - Modifica libro";
    $tp["identification"] = "book_details";
    $tp["content"] = './pages/detailedorder.php';
    
    $data = json_decode($_SESSION["expandedarticledata"],true);
    $isbn = $data["EAN"]."-".$data["CodiceRegGroup"]."-".$data["CodiceEditoriale"]."-".$data["CodiceTitolo"]."-".$data["NumeroCopia"];
    $tp["ISBN"] = $isbn;
    $tp["Titolo"] = $data["Titolo"];
    $tp["NomeAutore"] = $data["NomeAutore"];
    $tp["CognomeAutore"] = $data["CognomeAutore"];
    $tp["NomeEditore"] = $data["NomeEditore"];
    $tp["NumeroCopia"] = $data["NumeroCopia"];
    $tp["EAN"] = $data["EAN"];
    $tp["CodiceRegGroup"] = $data["CodiceRegGroup"];
    $tp["CodiceEditoriale"] = $data["CodiceEditoriale"];
    $tp["CodiceTitolo"] = $data["CodiceTitolo"];
    $tp["Prezzo"] = $data["Prezzo"];
    $tp["DescrizioneAnnuncio"] = $data["DescrizioneAnnuncio"];
    
    array_push($tp["js"], "./js/modifybook.js");
    require './template/base.php';
?>