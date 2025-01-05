<?php
    require './bootstrap.php';
    define('DIRECT_ACCESS',true);
    
    $tp["title"] = "SegnaLibro - Dettagli libro";
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
    
    array_push($tp["js"], "./js/book_details.js");
    require './template/base.php';
?>