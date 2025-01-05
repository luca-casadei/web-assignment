<?php
    require './bootstrap.php';
    define('DIRECT_ACCESS',true);

    $data = json_decode($_SESSION["expandedarticledata"],true);
    $isbn = $data["EAN"]."-".$data["CodiceRegGroup"]."-".$data["CodiceEditoriale"]."-".$data["CodiceTitolo"]."-".$data["NumeroCopia"];
    $tp["ISBN"] = $isbn;
    $tp["Titolo"] = $data["Titolo"];
    $tp["title"] = "SegnaLibro - Dettagli libro";
    $tp["identification"] = "book_details";
    $tp["content"] = './pages/detailedorder.php';
    $tp["NomeAutore"] = $data["NomeAutore"];
    $tp["CognomeAutore"] = $data["CognomeAutore"];
    $tp["NomeEditore"] = $data["NomeEditore"];
    array_push($tp["js"], "./js/book_details.js");

    require './template/base.php';
?>