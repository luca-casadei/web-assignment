<?php
    require './bootstrap.php';
    if (!isset($_SESSION["expandedbookdata"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - Modifica libro";
    $tp["identification"] = "book_modify";
    $tp["content"] = './pages/vendor/modifybook.php';
    
    $data = json_decode($_SESSION["expandedbookdata"],true);
    $tp["CodiceEditoriale"] = $data["CodiceEditoriale"];
    $tp["CodiceRegGroup"] = $data["CodiceRegGroup"];
    $tp["EAN"] = $data["EAN"];
    $tp["CodiceTitolo"] = $data["CodiceTitolo"];
    $tp["Titolo"] = $data["Titolo"];
    $tp["Descrizione"] = $data["Descrizione"];
    $tp["DataPubblicazione"] = $data["DataPubblicazione"];
    $tp["NomeAutore"] = $data["NomeAutore"];
    $tp["CognomeAutore"] = $data["CognomeAutore"];
    $tp["NomeCategoria"] = $data["NomeCategoria"];
    $tp["NomeEditore"] = $data["NomeEditore"];
    
    array_push($tp["js"], "./js/vendor/modifybook.js");
    require './template/base.php';
?>